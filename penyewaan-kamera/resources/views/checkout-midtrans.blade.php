@extends('layouts.app')

@section('content')
<style>
    .payment-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        padding: 30px;
        margin-bottom: 30px;
        height: 100%;
    }

    .payment-section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        border-bottom: 2px solid #eee;
        padding-bottom: 10px;
    }

    .info-text {
        font-size: 1rem;
        margin-bottom: 8px;
        color: #555;
    }

    .info-text strong {
        color: #000;
    }

    .custom-table thead {
        background-color: #f8f9fa;
    }

    .custom-table th,
    .custom-table td {
        vertical-align: middle !important;
        text-align: center;
    }

    .btn-pay {
        font-size: 1.1rem;
        font-weight: 600;
        padding: 12px 30px;
        border-radius: 10px;
        transition: 0.3s ease;
    }

    .btn-pay:hover {
        background-color: #0056b3 !important;
    }

    .section-wrapper {
        max-width: 1000px;
        margin: auto;
    }
</style>


<div class="container my-5 section-wrapper">
    <h2 class="mb-5 text-center">💳 Lanjutkan Pembayaran</h2>

    {{-- SECTION: Data User & Pemesanan --}}
    <div class="row mb-4">
        {{-- Data Pengguna --}}
        <div class="col-md-6">
            <div class="payment-card h-100">
                <div class="payment-section-title">👤 Data Pengguna</div>
                <p class="info-text"><strong>Nama:</strong> {{ $user->name }}</p>
                <p class="info-text"><strong>Email:</strong> {{ $user->email }}</p>
            </div>
        </div>

        {{-- Data Pemesanan --}}
        <div class="col-md-6">
            <div class="payment-card h-100">
                <div class="payment-section-title">📦 Data Pemesanan</div>
                <p class="info-text"><strong>ID Pemesanan:</strong> {{ $pemesanan->id }}</p>
                <p class="info-text"><strong>Total Pembayaran:</strong> Rp{{ number_format($pemesanan->total, 0, ',', '.') }}</p>
                <p class="info-text"><strong>Status Pembayaran:</strong>
                    <span class="badge bg-{{ $pemesanan->status_pembayaran == 'settlement' ? 'success' : ($pemesanan->status_pembayaran == 'pending' ? 'warning text-dark' : 'danger') }}">
                        {{ ucfirst($pemesanan->status_pembayaran) }}
                    </span>
                </p>
            </div>
        </div>
    </div>

    {{-- SECTION: Detail Pemesanan --}}
<div class="payment-card">
    <div class="payment-section-title">📝 Detail Pemesanan</div>
    <div class="table-responsive">
        <table class="table table-bordered custom-table">
            <thead>
                <tr>
                    <th>Foto Produk</th>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Waktu Pengambilan</th>
                    <th>Waktu Pengembalian</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detailPemesanan as $detail)
                <tr>
                    <td>
                        @if($detail->produk && $detail->produk->foto)
                            <img src="{{ asset('storage/' . $detail->produk->foto) }}" alt="{{ $detail->produk->nama_produk }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                        @else
                            <div class="bg-secondary rounded" style="width: 60px; height: 60px;"></div>
                        @endif
                    </td>
                    <td>{{ $detail->produk->nama_produk ?? 'Tidak Diketahui' }}</td>
                    <td>{{ $detail->jumlah_item }}</td>
                    <td>{{ \Carbon\Carbon::parse($detail->waktu_pengambilan)->format('d-m-Y H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($detail->waktu_pengembalian)->format('d-m-Y H:i') }}</td>
                    <td>Rp{{ number_format($detail->harga, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


    {{-- SECTION: Tombol Bayar --}}
    <div class="text-center">
        <button id="pay-button" class="btn btn-primary btn-pay">
             Bayar Sekarang
        </button>
    </div>
</div>

{{-- SECTION: Midtrans Script --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    document.getElementById('pay-button').onclick = function() {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                alert('Pembayaran berhasil! Silakan tunggu konfirmasi dari sistem.');
                window.location.href = "{{ route('checkout.success') }}";
            },
            onPending: function(result) {
                alert('Pembayaran pending, silakan cek status pesanan Anda.');
            },
            onError: function(result) {
                alert('Pembayaran gagal, silakan coba lagi.');
            },
            onClose: function() {
                alert('Anda menutup popup pembayaran.');
            }
        });
    };
</script>

@endsection
