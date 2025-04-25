@extends('layouts.app') {{-- Ganti jika layout kamu berbeda --}}

@section('content')

<!-- ===================== CART POPUP ===================== -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">Your Cart</span>
            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            {{-- ✅ LOOP DATA PRODUK DI CART --}}
            <ul class="header-cart-wrapitem w-full">
                @foreach ($cartItems as $item)
                <li class="header-cart-item flex-w flex-t m-b-12">
                    <div class="header-cart-item-img">
                        <img src="{{ asset('storage/' . $item->produk->foto) }}" alt="IMG">
                    </div>
                    <div class="header-cart-item-txt p-t-8">
                        <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                            {{ $item->produk->nama_produk }}
                        </a>
                        <span class="header-cart-item-info">
                            {{ $item->jumlah }} x Rp{{ number_format($item->produk->harga, 0, ',', '.') }}
                        </span>
                    </div>
                </li>
                @endforeach
            </ul>

            {{-- ✅ TOTAL DI CART --}}
            <div class="w-full">
                @php
                    $totalHeader = 0;
                    foreach ($cartItems as $item) {
                        $totalHeader += $item->produk->harga * $item->jumlah;
                    }
                @endphp

                <div class="header-cart-total w-full p-tb-40">
                    Total: Rp{{ number_format($totalHeader, 0, ',', '.') }}
                </div>

                <div class="header-cart-buttons flex-w w-full">
                    <a href="{{ route('cart.index') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        View Cart
                    </a>
                    <a href="{{ route('checkout.index') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                        Check Out
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ===================== CART TABLE ===================== -->
<form class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                            </tr>

                            {{-- ✅ LOOP ISI CART --}}
                            @php $total = 0; @endphp
                            @foreach ($cartItems as $item)
                            @php
                                $subTotal = $item->produk->harga * $item->jumlah;
                                $total += $subTotal;
                            @endphp
                            <tr class="table_row">
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="{{ asset('storage/' . $item->produk->foto) }}" alt="IMG">
                                    </div>
                                </td>
                                <td class="column-2">{{ $item->produk->nama_produk }}</td>
                                <td class="column-3">Rp{{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                                <td class="column-4">
                                    {{-- ✅ FORM UPDATE JUMLAH PRODUK --}}
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex">
                                        @csrf
                                        @method('PUT')
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <button name="action" value="decrease" class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" type="submit">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </button>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number" name="jumlah" value="{{ $item->jumlah }}">

                                            <button name="action" value="increase" class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" type="submit">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                                <td class="column-5">Rp{{ number_format($subTotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <!-- ===================== CART TOTAL ===================== -->
            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">Cart Totals</h4>

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208"><span class="stext-110 cl2">Subtotal:</span></div>
                        <div class="size-209"><span class="mtext-110 cl2">Rp{{ number_format($total, 0, ',', '.') }}</span></div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208"><span class="mtext-101 cl2">Total:</span></div>
                        <div class="size-209 p-t-1"><span class="mtext-110 cl2">Rp{{ number_format($total, 0, ',', '.') }}</span></div>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
