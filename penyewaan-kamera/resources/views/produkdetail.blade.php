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

                            <div class="w-full max-w-xl p-6 bg-white rounded-2xl shadow-lg">
                                <form action="{{ route('cart.tambah') }}" method="POST" class="space-y-4">
                                    @csrf
                                    <input type="hidden" name="produks_id" value="{{ $produk->id }}">
                                    <input type="hidden" id="harga_per_hari" value="{{ $produk->harga }}">

                                    <!-- Jumlah Item -->
                                    <div>
                                        <label for="jumlah_item" class="block text-sm font-semibold text-gray-700">Jumlah Item</label>
                                        <input type="number" name="jumlah_item" id="jumlah_item" min="1" required value="1"
                                            class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                                            oninput="hitungHarga()">
                                    </div>

                                    <!-- Tanggal Pengambilan -->
                                    <div>
                                        <label for="waktu_pengambilan" class="block text-sm font-semibold text-gray-700">Tanggal & Waktu Pengambilan</label>
                                        <input type="datetime-local" name="waktu_pengambilan" id="waktu_pengambilan" required
                                            class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                                            onchange="hitungHarga()">
                                    </div>

                                    <!-- Tanggal Pengembalian -->
                                    <div>
                                        <label for="tanggal_pengembalian" class="block text-sm font-semibold text-gray-700">Tanggal Pengembalian</label>
                                        <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" required
                                            class="w-full px-4 py-2 mt-1 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                                            onchange="hitungHarga()">
                                    </div>

                                    <!-- Total Harga -->
                                    <div>
                                        <label for="total_harga" class="block text-sm font-semibold text-gray-700">Total Harga</label>
                                        <input type="text" id="total_harga" readonly
                                            class="w-full px-4 py-2 mt-1 bg-gray-100 border rounded-lg cursor-not-allowed">
                                    </div>

                                    <!-- Tombol Submit -->
                                    <div class="text-right">
                                        <button type="submit"
                                            class="px-6 py-2 text-black bg-black rounded-lg hover:bg-gray-800 transition duration-200">
                                            Tambah ke Keranjang
                                        </button>

                                    </div>
                                </form>
                            </div>

                            <script>
                                function hitungHarga() {
                                    const hargaPerHari = parseFloat(document.getElementById('harga_per_hari').value);
                                    const jumlahItem = parseInt(document.getElementById('jumlah_item').value);
                                    const waktuPengambilan = new Date(document.getElementById('waktu_pengambilan').value);
                                    const tanggalPengembalian = new Date(document.getElementById('tanggal_pengembalian').value);

                                    tanggalPengembalian.setHours(waktuPengambilan.getHours());
                                    tanggalPengembalian.setMinutes(waktuPengambilan.getMinutes());
                                    tanggalPengembalian.setSeconds(waktuPengambilan.getSeconds());

                                    const timeDiff = tanggalPengembalian - waktuPengambilan;
                                    const dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
                                    const durasiSewa = dayDiff > 0 ? dayDiff : 1;

                                    const totalHarga = hargaPerHari * jumlahItem * durasiSewa;
                                    document.getElementById('total_harga').value = "Rp " + totalHarga.toLocaleString();
                                }

                                hitungHarga();
                            </script>

                        </div>

                        </div>
                    </div>

                    <!-- Share & Wishlist -->
                    {{-- <div class="flex-w flex-m p-l-100 p-t-40 respon7">
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
                    </div> --}}
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
