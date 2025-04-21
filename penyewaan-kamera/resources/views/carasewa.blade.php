@extends('layouts.app') {{-- Ganti jika layout kamu namanya berbeda --}}

@section('content')

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92"style="background-image: url('{{ asset('images/bg-02.jpg') }}');">
    <h2 class="ltext-105 cl0 txt-center">
        How to Rent
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
                        Panduan Penyewaan
                    </h3>

                    <ol style="padding-left: 20px;">
                        <li style="margin-bottom: 15px;">
                            <strong>1. Durasi Penyewaan</strong>
                            <p style="margin-left: 20px; margin-top: 5px;">
                                Berlaku 24 jam dari waktu pengambilan dengan toleransi keterlambatan 2 jam, lebih dari itu dikenakan denda.
                            </p>
                        </li>

                        <li style="margin-bottom: 15px;">
                            <strong>2. Jaminan Penyewaan</strong>
                            <p style="margin-left: 20px; margin-top: 5px;">
                                Domisili Sumbar: 2 identitas asli (KTP, SIM, dll). Untuk domisili luar Sumbar: 5 identitas asli.
                            </p>
                        </li>


                        <li style="margin-bottom: 15px;">
                            <strong>3. Proses Penyewaan</strong>
                            <ol style="margin-left: 20px; margin-top: 5px; list-style-type: decimal;">
                                <li style="margin-bottom: 5px;">1.  Pilih alat & reservasi.</li>
                                <li style="margin-bottom: 5px;">2. Siapkan dokumen jaminan.</li>
                                <li style="margin-bottom: 5px;">3. Lakukan pembayaran.</li>
                                <li>4. Ambil & kembalikan alat tepat waktu.</li>
                            </ol>
                        </li>
                    </ol>

                </div>
            </div>

            <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                <div class="how-bor1">
                    <div class="hov-img0">
                        <img src="{{ asset('images/panduan1.jpg') }}" alt="About Image 1">
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Mission -->
        <div class="row">
            <div class="order-md-2 col-md-7 col-lg-8 p-b-30">
                <div class="p-t-7 p-l-85 p-l-15-lg p-l-0-md">
                    <h3 class="mtext-111 cl2 p-b-16">
                        Kebijakan Highspeed
                    </h3>
                    <li style="margin-bottom: 15px;">
                        <strong>1. Keamanan & tanggung jawab</strong>
                        <p style="margin-left: 20px; margin-top: 5px;">
                            Berlaku 24 jam dari waktu pengambilan dengan toleransi keterlambatan 2 jam, lebih dari itu dikenakan denda.
                        </p>

                        <strong>2. Pembatalan & perubahan jadwal</strong>
                        <p style="margin-left: 20px; margin-top: 5px;">
                                Pembatalan max H-1 sebelum pengambilan.Perubahan jadwal bedasarkan ketersediaan.
                        </p>

                        <strong>3. Sanksi & Denda</strong>
                        <p style="margin-left: 20px; margin-top: 5px;">
                            Keterlambatan lebih 2 jam dikenakan denda.
                            Keterlambatan lebih dari 24 jam dikenakan tarif
                            penyewaan tambahan.
                        </p>


                    </li>


                    <div class="bor16 p-l-29 p-b-9 m-t-22">
                        <p class="stext-114 cl6 p-r-40 p-b-11">
                            Pahami aturan ini untuk pengalaman sewa yang lancar. Tim Highspeed siap membantu!

                        </p>
                        <span class="stext-111 cl8">
                            - Tim Highspeed
                        </span>
                    </div>
                </div>
            </div>

            <div class="order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30">
                <div class="how-bor2">
                    <div class="hov-img0">
                        <img src="{{ asset('images/panduan2.jpg') }}" alt="About Image 2">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
