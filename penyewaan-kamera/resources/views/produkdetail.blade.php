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
            <!-- Gambar Produk -->
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
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Produk -->
            <div class="col-md-6 col-lg-5 p-b-30">
                <div class="p-r-50 p-t-5 p-lr-0-lg">
                    <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                        {{ $produk->nama_produk }}
                    </h4>

                    <span class="mtext-106 cl2 text-primary fw-bold">
                        Rp {{ number_format($produk->harga, 0, ',', '.') }}
                    </span>

                    <p class="stext-102 cl3 p-t-20">
                        <strong>Deskripsi:</strong> {{ $produk->deskripsi }}
                    </p>

                    <p class="stext-102 cl3 p-t-10">
                        <strong>Stok Tersedia:</strong> {{ $produk->stok }}
                    </p>

                    <!-- Form Penyewaan -->
                    <div class="mt-4 p-4 bg-light rounded-4 shadow-sm">
                        <form action="{{ route('cart.tambah') }}" method="POST">
                            @csrf
                            <input type="hidden" name="produks_id" value="{{ $produk->id }}">
                            <input type="hidden" id="harga_per_hari" value="{{ $produk->harga }}">

                            <!-- Jumlah Item -->
                            <div class="mb-3">
                                <label for="jumlah_item" class="form-label fw-semibold">Jumlah Item</label>
                                <input type="number" name="jumlah_item" id="jumlah_item" min="1" max="{{ $produk->stok }}" required value="1" class="form-control" oninput="hitungHarga()">
                            </div>

                            <!-- Tanggal Pengambilan -->
                            <div class="mb-3">
                                <label for="waktu_pengambilan" class="form-label fw-semibold">Tanggal & Waktu Pengambilan</label>
                                <input type="datetime-local" name="waktu_pengambilan" id="waktu_pengambilan" class="form-control" required onchange="hitungHarga()">
                            </div>

                            <!-- Tanggal Pengembalian -->
                            <div class="mb-3">
                                <label for="tanggal_pengembalian" class="form-label fw-semibold">Tanggal Pengembalian</label>
                                <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control" required onchange="hitungHarga()">
                            </div>

                            <!-- Total Harga -->
                            <div class="mb-4">
                                <label for="total_harga" class="form-label fw-semibold">Total Harga</label>
                                <input type="text" id="total_harga" class="form-control bg-secondary-subtle text-dark" readonly>
                            </div>

                            <button type="submit" class="btn btn-dark w-100 py-2 fw-semibold">
                                🛒 Tambah ke Keranjang
                            </button>
                        </form>
                    </div>

                    <script>
                        function hitungHarga() {
                            const hargaPerHari = parseFloat(document.getElementById('harga_per_hari').value);
                            const jumlahItem = parseInt(document.getElementById('jumlah_item').value);
                            const waktuPengambilan = new Date(document.getElementById('waktu_pengambilan').value);
                            const tanggalPengembalian = new Date(document.getElementById('tanggal_pengembalian').value);

                            if (isNaN(waktuPengambilan) || isNaN(tanggalPengembalian)) return;

                            tanggalPengembalian.setHours(waktuPengambilan.getHours());
                            tanggalPengembalian.setMinutes(waktuPengambilan.getMinutes());

                            const timeDiff = tanggalPengembalian - waktuPengambilan;
                            const dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
                            const durasiSewa = dayDiff > 0 ? dayDiff : 1;

                            const totalHarga = hargaPerHari * jumlahItem * durasiSewa;
                            document.getElementById('total_harga').value = "Rp " + totalHarga.toLocaleString('id-ID');
                        }

                        hitungHarga();
                    </script>
                </div>
            </div>
        </div>

        <!-- Info Tambahan -->
        <div class="bor10 m-t-50 p-t-43 p-b-40">
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

        <!-- Footer Info -->
        <div class="bg6 flex-c-m flex-w size-302 m-t-73 p-tb-15">
            <span class="stext-107 cl6 p-lr-25">Nama Produk: {{ $produk->nama_produk }}</span>
            <span class="stext-107 cl6 p-lr-25">Kategori: {{ $produk->kategori->nama }}</span>
        </div>
    </div>
</section>
@endsection
