<header class="header-v2">
    <!-- Header desktop -->
    <div class="container-menu-desktop trans-03">
        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop p-l-45">

                <!-- Logo desktop -->
                <a href="#" class="logo">
                    <img src="{{ asset('assets/compiled/svg/hs.png') }}" alt="IMG-LOGO" class="img-fluid" style="max-width: 100px;">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="{{ request()->routeIs('home') ? 'active-menu text-danger' : '' }}">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="{{ request()->routeIs('about') ? 'active-menu text-danger' : '' }}">
                            <a href="{{ route('about') }}">About</a>
                        </li>
                        <li class="label1 {{ request()->is('produk') ? 'active-menu text-danger' : '' }}" data-label1="hot">
                            <a href="{{ url('/produk') }}">Equipment</a>
                        </li>
                        <li class="{{ request()->routeIs('carasewa') ? 'active-menu text-danger' : '' }}">
                            <a href="{{ route('carasewa') }}">How To Rent</a>
                        </li>
                        <li class="{{ request()->routeIs('contact') ? 'active-menu text-danger' : '' }}">
                            <a href="{{ route('contact') }}">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m h-full">
                    {{-- <div class="flex-c-m h-full p-r-24">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 js-show-modal-search">
                            <i class="zmdi zmdi-search"></i>
                        </div>
                    </div> --}}

                    <div class="flex-c-m h-full p-l-18 p-r-25 bor5">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11 icon-header-noti js-show-cart" data-notify="2">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>
                    </div>

                    <div class="flex-c-m h-full p-lr-19">
                        @auth
                            <a href="{{ route('profile.show') }}" class="flex items-center">
                                <img src="{{ asset('login/images/avatar.jpeg') }}" alt="Profile" class="rounded-full border-2 border-gray-300" width="50" height="50">
                            </a>
                        @else
                            <a href="{{ route('register.show') }}" class="icon-header-item cl2 hov-cl1 trans-04 p-lr-11">
                                <i class="zmdi zmdi-account"></i>
                            </a>
                        @endauth
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>

<!-- Tambahkan style berikut di bawah atau di file CSS -->
<style>
    .main-menu .text-danger > a {
        color: red !important;
    }
    .main-menu li a:hover {
        color: red;
    }
</style>
