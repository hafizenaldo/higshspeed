@extends('layouts.app')

@section('content')
<form class="bg0 p-t-75 p-b-85">
    <div class="container">
        <h2 class="mb-4">Keranjang Penyewaan</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($keranjang->isEmpty())
            <p>Keranjang kamu kosong.</p>
            <a href="{{ route('produk.index') }}" class="btn btn-primary mt-3">Lihat Produk</a>
        @else
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Product</th>
                                <th class="column-2">Name</th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                            </tr>

                            @foreach($keranjang as $item)
                            <tr class="table_row">
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="{{ asset('storage/' . $item->produk->foto) }}" alt="{{ $item->produk->nama_produk }}">
                                    </div>
                                </td>
                                <td class="column-2">
                                    {{ $item->produk->nama_produk }}<br>
                                    <small>
                                        Ambil: {{ \Carbon\Carbon::parse($item->waktu_pengambilan)->format('d-m-Y H:i') }} <br>
                                        Kembali: {{ \Carbon\Carbon::parse($item->waktu_pengembalian)->format('d-m-Y H:i') }}
                                    </small>
                                </td>
                                <td class="column-3">Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                                <td class="column-4">{{ $item->jumlah_item }}</td>
                                <td class="column-5">Rp {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <!-- Total -->
            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>

                    @php
                        $total = $keranjang->sum('sub_total');
                    @endphp

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Subtotal:
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>

                    </div>

                    {{-- <a href="{{ route('checkout.index') }}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Lanjutkan ke Pembayaran
                    </a> --}}
                </div>

            </div>
        </div>

        <!-- TOMBOL KEMBALI -->
        <div class="text-left mt-4">
            <a href="{{ url('/produk') }}" class="btn btn-outline-secondary">
                Kembali ke Halaman Produk
            </a>
        </div>
        @endif
    </div>
</form>
@endsection
