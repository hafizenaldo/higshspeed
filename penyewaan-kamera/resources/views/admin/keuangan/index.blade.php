@extends('admin.layouts.app')

@section('content')
<div class="container">

    {{-- Ringkasan Keuangan di Paling Atas --}}
    <h1>Manajemen Keuangan</h1>
    <p>Laporan pemasukan dan pengeluaran</p>
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="p-3 text-white" style="background-color: #ddff00; border-radius: 8px;">
                <h6>Pemasukan Manual:</h6>
                <h4>Rp {{ number_format($totalPemasukanManual, 0, ',', '.') }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 text-white" style="background-color: #17a2b8; border-radius: 8px;">
                <h6>Pemasukan Pemesanan:</h6>
                <h4>Rp {{ number_format($totalPemasukanPemesanan, 0, ',', '.') }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 text-white" style="background-color: #dc3545; border-radius: 8px;">
                <h6>Pengeluaran:</h6>
                <h4>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h4>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 text-white" style="background-color: #1ddb6f; border-radius: 8px;">
                <h6>Total Saldo:</h6>
                <h4>Rp {{ number_format($totalSaldo, 0, ',', '.') }}</h4>
            </div>
        </div>
    </div>

    {{-- Tombol Tambah Transaksi --}}
    <div class="mb-3">
        <a href="{{ route('keuangan.create') }}" class="btn btn-primary">+ Tambah Transaksi Manual</a>
    </div>

    {{-- Form Cetak PDF --}}
    {{-- <form action="{{ route('keuangan.cetak') }}" method="GET" class="row g-2 mb-3"> --}}
        <div class="row g-3">
    <div class="col-md-4">
        <label for="tanggal_awal" class="form-label fw-bold">Tanggal Awal</label>
        <input type="date" id="tanggal_awal" name="tanggal_awal"
               class="form-control" required>
    </div>
    <div class="col-md-4">
        <label for="tanggal_akhir" class="form-label fw-bold">Tanggal Akhir</label>
        <input type="date" id="tanggal_akhir" name="tanggal_akhir"
               class="form-control" required>
    </div>
</div>

        {{-- <div class="col-md-4">
            <button type="submit" class="btn btn-success">Cetak PDF</button>
        </div> --}}
    </form>

    {{-- Tabel Data Keuangan --}}
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th>Sumber</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($keuangans as $k)
            <tr>
                <td>{{ \Carbon\Carbon::parse($k->tanggal)->format('d/m/Y') }}</td>
                <td>{{ ucfirst($k->jenis_transaksi) }}</td>
                <td>{{ $k->keterangan }}</td>
                <td>Rp {{ number_format($k->jumlah, 0, ',', '.') }}</td>
                <td>{{ ucfirst($k->sumber) }}</td>
                <td>
                    @if ($k->sumber == 'manual')
                        <a href="{{ route('keuangan.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('keuangan.destroy', $k->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    @else
                        <span class="badge bg-info">Otomatis</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
