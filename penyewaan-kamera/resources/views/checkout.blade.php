@extends('layouts.app')

@section('content')
<style>
    .checkout-container {
        max-width: 1100px;
        margin: auto;
        padding: 40px;
        background: #fff;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        border-radius: 12px;
        font-family: 'Arial', sans-serif;
    }

    .checkout-header {
        text-align: center;
        margin-bottom: 40px;
        font-size: 2rem;
        font-weight: bold;
        color: #333;
    }

    .checkout-main {
        display: flex;
        gap: 40px;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .user-details, .product-details {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        width: 100%;
        margin-bottom: 30px;
    }

    .user-details {
        flex: 1;
    }

    .product-details {
        flex: 2;
    }

    .form-label {
        font-weight: bold;
        margin-bottom: 8px;
        color: #555;
    }

    .form-control {
        font-size: 1rem;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
        margin-bottom: 20px;
        width: 100%;
        box-sizing: border-box;
    }

    .checkout-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 25px;
    }

    .checkout-table th, .checkout-table td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: center;
        vertical-align: middle;
    }

    .checkout-table th {
        background-color: #f1f1f1;
        font-weight: 600;
        color: #333;
    }

    .product-img {
        max-width: 120px;
        border-radius: 8px;
    }

    .total-container {
        margin-top: 30px;
        background-color: #fafafa;
        padding: 20px;
        border-radius: 12px;
    }

    .total-container .flex-w {
        display: flex;
        justify-content: space-between;
        margin: 12px 0;
        font-size: 1rem;
    }

    .mtext-110 {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
    }

    .checkout-btn {
        display: inline-block;
        margin-top: 20px;
        padding: 12px 35px;
        background-color: #007bff;
        color: #fff;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        text-align: center;
        transition: 0.3s;
        width: 100%;
    }

    .checkout-btn:hover {
        background-color: #0056b3;
    }

    .checkout-btn:active {
        background-color: #003f7f;
    }

    .checkout-btn-container {
        text-align: center;
    }

    /* Styling specific to form layout */
    .form-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .form-group {
        flex: 1;
        min-width: 250px;
    }

</style>

<div class="container my-5">
    <div class="checkout-container">
        <h2 class="checkout-header">Detail Checkout</h2>
        <div class="checkout-main">



            {{-- Product Info --}}
            <div class="product-details">
                <h4 class="mb-4">Detail Produk</h4>
                <table class="checkout-table">
                    <thead>
                        <tr>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Waktu Pengambilan</th>
                            <th>Waktu Pengembalian</th>
                            <th>Lama Sewa</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($carts as $item)
                        @php
                            $waktuAmbil = \Carbon\Carbon::parse($item->waktu_pengambilan);
                            $waktuKembali = \Carbon\Carbon::parse($item->waktu_pengembalian);
                            $jumlahHari = $waktuAmbil->diffInDays($waktuKembali);
                            if ($jumlahHari === 0) $jumlahHari = 1;
                        @endphp
                        <tr>
                            <td><img src="{{ asset('storage/' . $item->produk->foto) }}" class="product-img" alt="{{ $item->produk->nama_produk }}"></td>
                            <td>{{ $item->produk->nama_produk ?? 'Tidak ditemukan' }}</td>
                            <td>Rp {{ number_format($item->produk->harga ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $item->jumlah_item }}</td>
                            <td>{{ $waktuAmbil->format('d-m-Y H:i') }}</td>
                            <td>{{ $waktuKembali->format('d-m-Y H:i') }}</td>
                            <td>{{ $jumlahHari }} hari</td>
                            <td>Rp {{ number_format($item->sub_total ?? 0, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="8">Keranjang kosong.</td></tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Total --}}
                @php
                    $total = $carts->sum(fn($item) => $item->sub_total);
                @endphp
                <div class="total-container">
                    <div class="flex-w">
                        <span>Subtotal:</span>
                        <span class="mtext-110">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex-w">
                        <span>Total:</span>
                        <span class="mtext-110">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="checkout-btn-container">

                        <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            <button id="pay-button" type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                Lanjutkan Pembayaran
                            </button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- @section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
      snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
          window.location.href = "{{ route('pemesanan.riwayat') }}";
        },
        onPending: function(result){
          window.location.href = "{{ route('pemesanan.riwayat') }}";
        },
        onError: function(result){
          alert('Pembayaran gagal. Silakan coba lagi.');
          window.location.href = "{{ route('pemesanan.riwayat') }}";
        }
      });
    };
</script>
@endsection --}}
