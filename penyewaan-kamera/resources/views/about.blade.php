@extends('layouts.app') {{-- Ganti jika layout kamu namanya berbeda --}}

@section('content')

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92"style="background-image: url('{{ asset('images/bg-02.jpg') }}');">
    <h2 class="ltext-105 cl0 txt-center">
        About
    </h2>
</section>

<!-- Content page -->
<section class="bg0 p-t-75 p-b-120">
    <div class="container">
        <!-- Our Story -->
        <div class="row p-b-148">
            <div class="col-md-7 col-lg-8">
                <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                    <h3 class="mtext-111 cl2 p-b-16">
                        Our Story
                    </h3>
                    <p class="stext-113 cl6 p-b-26" style="text-align: justify;">
                        Berawal dari kebutuhan sederhana di tahun 2015, Highspeed lahir dari berbagi ke teman-teman yang kerap meminjam kamera.Dengan peralatan yang masih terbatas, mengandalkan sistem bagi hasil dengan rekan-rekan, dan perlahan Highspeed mulai menemukan jalannya.Seiring meningkatnya permintaan, Highspeed bertransformasi.
                        Koleksi peralatan bertambah, layanan semakin profesional, dan cakupan pelanggan pun meluas
                    </p>
                    <p class="stext-113 cl6 p-b-26" style="text-align: justify;">
                        Hari ini Highspeed bukan hanya sekadar tempat sewa kamera, Highspeed menjadi mitra utama bagi fotografer, videografer, komunitas kreatif, hingga mahasiswa yang ingin mendokumentasikan karya mereka dengan kualitas terbaik.

                        Dari sebuah inisiatif kecil hingga menjadi penyedia peralatan visual terlengkap di Padang, Highspeed terus berkembang.
                        Karena setiap momen berharga pantas diabadikan dengan sempurna.
                    </p>


                </div>
            </div>

            <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                <div class="how-bor1">
                    <div class="hov-img0">
                        <img src="{{ asset('images/about1.jpeg') }}" alt="About Image 1">
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Mission -->
        <div class="row">
            <div class="order-md-2 col-md-7 col-lg-8 p-b-30">
                <div class="p-t-7 p-l-85 p-l-15-lg p-l-0-md">
                    <h3 class="mtext-111 cl2 p-b-16">
                        Owner
                    </h3>
                    <p class="stext-113 cl6 p-b-26">
                        Mauris non lacinia magna. Sed nec lobortis dolor. Vestibulum rhoncus dignissim risus...
                    </p>

                    <div class="bor16 p-l-29 p-b-9 m-t-22">
                        <p class="stext-114 cl6 p-r-40 p-b-11">
                            Creativity is just connecting things. When you ask creative people how they did something, they feel a little guilty...
                        </p>
                        <span class="stext-111 cl8">
                            - Steve Job’s
                        </span>
                    </div>
                </div>
            </div>

            <div class="order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30">
                <div class="how-bor2">
                    <div class="hov-img0">
                        <img src="{{ asset('images/about2.png') }}" alt="About Image 2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
