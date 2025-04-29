@extends('layouts.app')

@section('content')
<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="{{ url('/') }}" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="{{ route('produk.index') }}" class="stext-109 cl8 hov-cl1 trans-04">
            Produk
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            {{ $produk->nama_produk }}
        </span>
    </div>
</div>

<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-lg-7 p-b-30">
                <div class="p-l-25 p-r-30 p-lr-0-lg">
                    <div class="wrap-slick3 flex-sb flex-w">
                        <div class="wrap-slick3-dots"></div>
                        <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                        <div class="slick3 gallery-lb">
                            <div class="item-slick3" data-thumb="{{ asset('storage/' . $produk->foto) }}">
                                <div class="wrap-pic-w pos-relative">
                                    <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama_produk }}">

                                    <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{ asset('storage/' . $produk->foto) }}">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- Tambah thumbnail lain kalau ada -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        {{ $produk->nama_produk }}
                    </h4>

                    <span class="mtext-106 cl2">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </span>


                    <p class="stext-102 cl3 p-t-23">
                     Deskripsi : {{ $produk->deskripsi }}
                    </p>

                    <div class="p-t-23">
                        <!-- Stok -->
                    <p class="stext-102 cl3 p-t-23">
                        Stok : {{ $produk->stok }}
                    </p>

                        <!-- Quantity & Dates -->
<div class="flex-w flex-r-m p-b-10">

    {{-- <!-- Tanggal Mulai -->
    <div class="m-b-10 w-full">
        <label for="tanggal_mulai" class="stext-102 cl3">Tanggal Pengambilan:</label>
        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control" required>
    </div>

    <!-- Tanggal Selesai -->
    <div class="m-b-10 w-full">
        <label for="tanggal_selesai" class="stext-102 cl3">Tanggal Pengembalian:</label>
        <input type="date" name="tanggal_selesai" id="tanggal_selesai" class="form-control" required>
    </div> --}}

                            <!-- Quantity -->
                            <div class="size-204 flex-w flex-m respon6-next">
                                <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                    </div>

                                    <input id="jumlah" class="mtext-104 cl3 txt-center num-product"
                                           type="number" name="jumlah" value="1" min="1" max="{{ $produk->stok }}">

                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                    </div>
                                </div>

                                {{-- <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                    <input type="hidden" id="inputJumlah" name="jumlah" value="1">

                                    <div class="size-204 flex-w flex-m respon6-next">

                                        <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                            Add to cart
                                        </button>
                                    </div>
                                </form> --}}

                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const minusButton = document.querySelector('.btn-num-product-down');
                                    const plusButton = document.querySelector('.btn-num-product-up');
                                    const inputJumlah = document.getElementById('jumlah');
                                    const maxStok = parseInt(inputJumlah.getAttribute('max'));

                                    function validateInput() {
                                        let currentValue = parseInt(inputJumlah.value);

                                        if (isNaN(currentValue) || currentValue < 1) {
                                            inputJumlah.value = 1;
                                        } else if (currentValue > maxStok) {
                                            inputJumlah.value = maxStok;
                                        }
                                    }

                                    minusButton.addEventListener('click', function() {
                                        validateInput();
                                        let currentValue = parseInt(inputJumlah.value);
                                        if (currentValue > 1) {
                                            inputJumlah.value = currentValue - 1;
                                        }
                                    });

                                    plusButton.addEventListener('click', function() {
                                        validateInput();
                                        let currentValue = parseInt(inputJumlah.value);
                                        if (currentValue < maxStok) {
                                            inputJumlah.value = currentValue + 1;
                                        }
                                    });

                                    // Cek saat user mengetik
                                    inputJumlah.addEventListener('input', function() {
                                        validateInput();
                                    });

                                    // Cek juga saat user selesai mengetik (blur dari input)
                                    inputJumlah.addEventListener('blur', function() {
                                        validateInput();
                                    });
                                });
                            </script>



                        </div>

                        </div>
                    </div>

                    <!-- Share & Wishlist -->
                    <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                        <div class="flex-m bor9 p-r-10 m-r-11">
                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100" data-tooltip="Add to Wishlist">
                                <i class="zmdi zmdi-favorite"></i>
                            </a>
                        </div>
                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Google Plus">
                            <i class="fa fa-google-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="bor10 m-t-50 p-t-43 p-b-40">
            <!-- Tab info produk -->
            <div class="tab01">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item p-b-10">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">Deskripsi</a>
                    </li>
                </ul>

                <div class="tab-content p-t-43">
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <p class="stext-102 cl6">
                            {{ $produk->deskripsi }}
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
        <span class="stext-107 cl6 p-lr-25">
            Nama Produk : {{ $produk->nama_produk }}
        </span>
        <span class="stext-107 cl6 p-lr-25">
            Kategori : {{ $produk->kategori->nama }}
        </span>
    </div>
</section>
<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>

@endsection
