@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">Detail Pemesanan</h2>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Informasi Pemesan</div>
        <div class="card-body">
            <p><strong>Nama:</strong> {{ $pemesanan->user->name ?? 'Tidak tersedia' }}</p>
            <p><strong>Email:</strong> {{ $pemesanan->user->email ?? '-' }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-info text-white">Informasi Pemesanan</div>
        <div class="card-body">
            <p><strong>ID Pemesanan:</strong> {{ $pemesanan->id }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($pemesanan->total, 0, ',', '.') }}</p>
            <p><strong>Status Pembayaran:</strong> {{ ucfirst($pemesanan->status_pembayaran) }}</p>
            <p><strong>Tanggal Pemesanan:</strong> {{ $pemesanan->created_at->format('d-m-Y H:i') }}</p>
            <p><strong>Link Pembayaran:</strong><br>
                @if($pemesanan->link_pembayaran)
                    <a href="https://app.sandbox.midtrans.com/snap/v2/vtweb/{{ $pemesanan->link_pembayaran }}" target="_blank" class="btn btn-sm btn-success mt-2">Buka Pembayaran</a>
                @else
                    <span class="text-danger">Belum tersedia</span>
                @endif
            </p>
        </div>
    </div>

    @if($pemesanan->detailpemesanans && $pemesanan->detailpemesanans->count())
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">Detail Produk</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                        <th>Waktu Pengambilan</th>
                        <th>Waktu Pengembalian</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemesanan->detailpemesanans as $detail)
                        <tr>
                            <td>{{ $detail->produk->nama_produk ?? 'Tidak ditemukan' }}</td>
                            <td>{{ $detail->jumlah_item }}</td>
                            <td>Rp {{ number_format($detail->harga, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($detail->waktu_pengambilan)->format('d-m-Y H:i') }}</td>
                            <td>{{ \Carbon\Carbon::parse($detail->waktu_pengembalian)->format('d-m-Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <a href="{{ route('pemesanan.index') }}" class="btn btn-outline-secondary">← Kembali</a>
</div>
@endsection
