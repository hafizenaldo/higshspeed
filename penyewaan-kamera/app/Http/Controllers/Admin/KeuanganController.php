<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use App\Models\Pemesanan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function index()
    {
        // Data manual dari tabel keuangan
        $manualKeuangans = Keuangan::select(
            'id',
            'tanggal',
            'jenis_transaksi',
            'keterangan',
            'jumlah',
            DB::raw("'manual' as sumber")
        );

        // Data pemasukan otomatis dari pemesanan yang sudah paid
        $pemesananKeuangans = Pemesanan::where('status_pembayaran', 'paid')
            ->select(
                DB::raw("NULL as id"),
                DB::raw("created_at as tanggal"),
                DB::raw("'pemasukan' as jenis_transaksi"),
                DB::raw("CONCAT('Pembayaran Pemesanan ID ', id) as keterangan"),
                'total as jumlah',
                DB::raw("'pemesanan' as sumber")
            );

        // Gabungkan
        $keuangans = $manualKeuangans
            ->unionAll($pemesananKeuangans)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Hitung total
        $totalPemasukanManual = Keuangan::where('jenis_transaksi', 'pemasukan')->sum('jumlah');
        $totalPemasukanPemesanan = Pemesanan::where('status_pembayaran', 'paid')->sum('total');
        $totalPengeluaran = Keuangan::where('jenis_transaksi', 'pengeluaran')->sum('jumlah');

        $totalSaldo = $totalPemasukanManual + $totalPemasukanPemesanan - $totalPengeluaran;

        return view('admin.keuangan.index', compact(
            'keuangans',
            'totalPemasukanManual',
            'totalPemasukanPemesanan',
            'totalPengeluaran',
            'totalSaldo'
        ));
    }

    public function create()
    {
        return view('admin.keuangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_transaksi' => 'required|in:pemasukan,pengeluaran',
            'keterangan' => 'nullable|string',
            'jumlah' => 'required|numeric|min:0',
        ]);

        Keuangan::create($request->all());

        return redirect()->route('keuangan.index')
                         ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $keuangan = Keuangan::findOrFail($id);
        return view('admin.keuangan.edit', compact('keuangan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis_transaksi' => 'required|in:pemasukan,pengeluaran',
            'keterangan' => 'nullable|string',
            'jumlah' => 'required|numeric|min:0',
        ]);

        $keuangan = Keuangan::findOrFail($id);
        $keuangan->update($request->all());

        return redirect()->route('keuangan.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $keuangan = Keuangan::findOrFail($id);
        $keuangan->delete();

        return redirect()->route('admin.keuangan.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function cetak(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        if (!$tanggalAwal || !$tanggalAkhir) {
            return redirect()->back()->with('error', 'Tanggal awal dan akhir harus diisi.');
        }

        $tanggalAwal = Carbon::parse($tanggalAwal)->startOfDay();
        $tanggalAkhir = Carbon::parse($tanggalAkhir)->endOfDay();

        // Data manual
        $manualKeuangans = Keuangan::whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
            ->select(
                'id',
                'tanggal',
                'jenis_transaksi',
                'keterangan',
                'jumlah',
                DB::raw("'manual' as sumber")
            );

        // Data dari pemesanan paid
        $pemesananKeuangans = Pemesanan::where('status_pembayaran', 'paid')
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->select(
                DB::raw("NULL as id"),
                DB::raw("created_at as tanggal"),
                DB::raw("'pemasukan' as jenis_transaksi"),
                DB::raw("CONCAT('Pembayaran Pemesanan ID ', id) as keterangan"),
                'total as jumlah',
                DB::raw("'pemesanan' as sumber")
            );

        $keuangans = $manualKeuangans
            ->unionAll($pemesananKeuangans)
            ->orderBy('tanggal', 'desc')
            ->get();

        // Hitung total berdasarkan periode
        $totalPemasukanManual = Keuangan::where('jenis_transaksi', 'pemasukan')
            ->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
            ->sum('jumlah');

        $totalPemasukanPemesanan = Pemesanan::where('status_pembayaran', 'paid')
            ->whereBetween('created_at', [$tanggalAwal, $tanggalAkhir])
            ->sum('total');

        $totalPengeluaran = Keuangan::where('jenis_transaksi', 'pengeluaran')
            ->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
            ->sum('jumlah');

        $totalSaldo = $totalPemasukanManual + $totalPemasukanPemesanan - $totalPengeluaran;

        $pdf = Pdf::loadView('admin.keuangan.cetak', [
            'keuangans' => $keuangans,
            'totalPemasukanManual' => $totalPemasukanManual,
            'totalPemasukanPemesanan' => $totalPemasukanPemesanan,
            'totalPengeluaran' => $totalPengeluaran,
            'totalSaldo' => $totalSaldo,
            'tanggalAwal' => $tanggalAwal,
            'tanggalAkhir' => $tanggalAkhir,
        ]);

        return $pdf->download("laporan-keuangan-{$tanggalAwal->format('Ymd')}to{$tanggalAkhir->format('Ymd')}.pdf");
    }
}
