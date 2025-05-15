@extends('layouts.app')

@section('content')
<section id="profile" class="profile py-5" style="background-color: #f8f9fa; margin-top: 80px;">

    <div class="container">
        {{-- <h2 class="text-uppercase text-center mb-5 font-weight-bold text-danger">Profil Anda</h2> --}}

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded-lg overflow-hidden">

                <div class="card-header text-center py-5"
                    style="background: url('{{ asset('login/images/hs.jpg') }}') center/contain no-repeat; height: 250px;">
                    <div class="d-flex flex-column align-items-center">
                        <div class="profile-img mb-3 position-relative">

                       </div>
                       {{-- <h4 class="mb-0" style="color: white;">{{ $user->name }}</h4> <!-- Tetap putih -->
                       <small class="text-light">{{ $user->email }}</small> <!-- Email tetap warna putih --> --}}
                   </div>
               </div>

                    <div class="card-body bg-white">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item py-3">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="zmdi zmdi-email text-danger mr-3"></i>
                                    <div>
                                        <small class="text-muted">Email</small><br>
                                        <strong>{{ $user->email }}</strong>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex align-items-center">
                                    <i class="zmdi zmdi-phone text-danger mr-3"></i>
                                    <div>
                                        <small class="text-muted">No HP</small><br>
                                        <strong>{{ $user->nohp }}</strong>
                                    </div>
                                </div>
                            </li>

                            <li class="list-group-item py-3 d-flex align-items-center">
                                <i class="fas fa-calendar-alt text-danger mr-3"></i>
                                <div>
                                    <small class="text-muted">Bergabung Sejak</small><br>
                                    <strong>{{ $user->created_at->format('d M Y') }}</strong>
                                </div>
                            </li>
                        </ul>

                        <!-- Tombol Logout -->
                        <div class="text-center mt-4 mb-3">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger px-5 py-2 shadow-sm rounded-pill">
                                    Logout
                                </button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .profile-img img {
        transition: transform 0.4s ease;
    }
    .profile-img img:hover {
        transform: scale(1.1);
    }
</style>
@endsection
