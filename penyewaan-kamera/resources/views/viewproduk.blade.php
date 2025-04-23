@extends('layouts.app')

@section('content')

<!-- Product -->
<div class="bg0" style="margin-top: 100px;">

    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">

            {{-- EDIT: Kategori dinamis --}}
            <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                <a href="{{ route('produk') }}">
                    <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ request()->routeIs('produk') ? 'how-active1' : '' }}" data-filter="*">
                        All Products
                    </button>
                </a>

                {{-- EDIT: Loop kategori dari database --}}
                @foreach($kategoris as $kategori)
                    <a href="{{ route('produk.kategori', ['kategori' => $kategori->id]) }}">
                        <button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 {{ request()->is('produk/kategori/'.$kategori->id) ? 'how-active1' : '' }}">
                            {{ $kategori->nama }}
                        </button>
                    </a>
                @endforeach
            </div>

        </div>

        <div class="row isotope-grid">
            @foreach($produks as $produk)
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                    <!-- Block2 -->
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama_produk }}">

                            <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a href="{{ route('produk.detail', ['id' => $produk->id]) }}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{ $produk->nama_produk }}
                                </a>

                                <span class="stext-105 cl3">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                    <img class="icon-heart1 dis-block trans-04" src="{{ asset('images/icons/icon-heart-01.png') }}" alt="ICON">
                                    <img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{ asset('images/icons/icon-heart-02.png') }}" alt="ICON">

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Load more -->
        <div class="flex-c-m flex-w w-full p-t-45">
            <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                Load More
            </a>
        </div>
    </div>
</div>

@endsection
