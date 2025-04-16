@extends('admin.layouts.app')

@section('title', 'Daftar Produk')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Produk</h3>
                <p class="text-subtitle text-muted">Daftar produk yang tersedia</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Daftar Produk</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Produk</h5>
            </div>
            <div class="card-body">
                {{-- [UPDATED] --}}
                <div class="d-flex justify-content-between mb-3 align-items-center">

                    {{-- Dropdown entries per page --}}
                    <form action="{{ route('produk.index') }}" method="GET" class="d-flex align-items-center">
                        <label class="me-2 mb-0">
                            <select name="per_page" class="form-select form-select-sm" onchange="this.form.submit()" style="width: auto; display: inline-block;">
                                @foreach([10, 25, 50, 100] as $limit)
                                    <option value="{{ $limit }}" {{ request('per_page') == $limit ? 'selected' : '' }}>
                                        {{ $limit }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                        <span class="ms-1">entries per page</span>
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    </form>

                    {{-- Search + Tambah Produk --}}
                    <div class="d-flex">
                        <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm h-100 me-2">
                            + Tambah Produk
                        </a>
                        <form action="{{ route('produk.index') }}" method="GET" class="d-flex ">
                            <input type="text" name="search"
                                value="{{ request('search') }}"
                                class="form-control form-control-sm"
                                placeholder="Cari produk..."
                                style="width: 200px;"
                                oninput="this.form.submit()">
                            <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}">
                        </form>


                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produks as $produk)
                        <tr>
                            <td>
                                @if($produk->foto)
                                    <img src="{{ asset('storage/' . $produk->foto) }}" width="100">
                                @else
                                    <span>Tidak ada</span>
                                @endif
                            </td>
                            <td>{{ $produk->nama_produk }}</td>
                            <td>{{ $produk->kategori?->nama ?? 'Tidak ada kategori' }}</td>
                            <td>Rp {{ number_format($produk->harga) }}</td>
                            <td>{{ $produk->deskripsi }}</td>
                            <td>{{ $produk->stok }}</td>
                            <td>
                                <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Produk tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </section>
</div>
@endsection
