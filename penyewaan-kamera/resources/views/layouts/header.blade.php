<header class="header-v2">
    <!-- Header desktop -->
    <div class="container-menu-desktop trans-03">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop p-l-45">
                <style>
                    .main-menu > li.active-menu > a {
                        color: red !important;
                    }
                </style>
                <!-- Logo desktop -->
                <a href="{{ route('about') }}" class="logo">
                    <img src="{{ asset('assets/compiled/svg/hs.png') }}" alt="IMG-LOGO" class="img-fluid" style="max-width: 100px;">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="{{ request()->routeIs('home') ? 'active-menu' : '' }}">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="{{ request()->routeIs('about') ? 'active-menu' : '' }}">
                            <a href="{{ route('about') }}">About</a>
                        </li>
                        <li class="label1 {{ request()->is('produk') ? 'active-menu' : '' }}" data-label1="hot">
                            <a href="{{ url('/produk') }}">Equipment</a>
                        </li>
                        <li class="{{ request()->routeIs('carasewa') ? 'active-menu' : '' }}">
                            <a href="{{ route('carasewa') }}">How To Rent</a>
                        </li>
                        <li class="{{ request()->routeIs('contact') ? 'active-menu' : '' }}">
                            <a href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>

                </div>

                <!-- Icon header -->
                <!-- Icon header -->
                        <div class="wrap-icon-header flex-w flex-r-m h-full">
                            <div class="flex-c-m h-full p-r-24">
                            </div>

                            <!-- Ikon Riwayat Pemesanan -->
                            <div class="flex-c-m h-full p-l-18 p-r-25 bor5">
                                <a href="{{ route('pemesanan.riwayat') }}">
                                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11">
                                        <img src="{{ asset('images/icons/history.png') }}" alt="History" style="width: 24px; height: 24px;">
                                    </div>
                                </a>
                            </div>


                            <!-- Ikon Cart -->
                            <div class="flex-c-m h-full p-l-18 p-r-25 bor5">
                                <a href="{{ route('cart.index') }}">
                                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti" data-notify="2">
                                        <i class="zmdi zmdi-shopping-cart"></i>
                                    </div>
                                </a>
                            </div>

                            <!-- Avatar / Login -->
                            <div class="flex-c-m h-full p-lr-19">
                                @auth
                                    <div class="flex items-center">
                                        <a href="{{ route('profile.show') }}" style="color: #dc2626 !important; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">
                                            {{ Auth::user()->name }}
                                        </a>

                                    </div>
                                @else
                                    <a href="{{ route('login') }}" class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11">
                                        <i class="zmdi zmdi-account"></i>
                                    </a>
                                @endauth
                            </div>
                        </div>
            </nav>
        </div>
    </div>
</header>
