@extends('layouts.app') {{-- Ganti jika layout kamu namanya berbeda --}}

@section('content')
<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92"style="background-image: url('{{ asset('images/bg-02.jpg') }}');">
    <h2 class="ltext-105 cl0 txt-center">
        Contact
    </h2>
</section>

<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">

            <!-- Form -->
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">

                @if(session('success'))
                    <div class="alert alert-success text-center mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.submit') }}">
                    @csrf
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Send Us A Message
                    </h4>

                    <!-- Email Input -->
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30"
                               type="email" name="email" placeholder="Your Email Address" required>
                        <img class="how-pos4 pointer-none" src="{{ asset('images/icons/icon-email.png') }}" alt="ICON">
                    </div>

                    <!-- Message Input -->
                    <div class="bor8 m-b-30">
                        <textarea class="stext-111 cl2 plh3 size-120 p-lr-28 p-tb-25"
                                  name="msg" placeholder="How Can We Help?" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        Submit
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">

                <!-- Address -->
                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-map-marker"></span>
                    </span>
                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">Address</span>
                        <p class="stext-115 cl6 size-213 p-t-18">
                            Jl. Teuku Umar No.21, Alai Parak Kopi, Kec. Padang Utara, Kota Padang, Sumatera Barat 25171
                        </p>
                    </div>
                </div>

                <!-- Phone -->
                <div class="flex-w w-full p-b-42">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-phone-handset"></span>
                    </span>
                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">Let's Talk</span>
                        <p class="stext-115 cl1 size-213 p-t-18">+62 813 7856 8844</p>
                    </div>
                </div>

                <!-- Email -->
                <div class="flex-w w-full">
                    <span class="fs-18 cl5 txt-center size-211">
                        <span class="lnr lnr-envelope"></span>
                    </span>
                    <div class="size-212 p-t-2">
                        <span class="mtext-110 cl2">Sale Support</span>
                        <p class="stext-115 cl1 size-213 p-t-18">contact@example.com</p>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection
