@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Detail Pemesanan</h2>

    <p><strong>User:</strong> {{ $pemesanan->user->name ?? '-' }}</p>
    <p><strong>Total:</strong> Rp {{ number_format($pemesanan->total, 0, ',', '.') }}</p>
    <p><strong>Status Pembayaran:</strong> {{ $pemesanan->status_pembayaran }}</p>

    <h4 class="mt-4">Detail Produk:</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>
                <th>Waktu Pengambilan</th>
                <th>Waktu Pengembalian</th>
            </tr>
        </thead>
        <tbody>
            {{-- DIUBAH: dari detailPemesanan ke details --}}
            @foreach($pemesanan->details as $item)
                <tr>
                    <td>{{ $item->produk->nama ?? '-' }}</td>
                    <td>{{ $item->jumlah_item }}</td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                    <td>{{ $item->waktu_pengambilan }}</td>
                    <td>{{ $item->waktu_pengembalian }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary">Kembali</a>
</div>
@endsection
