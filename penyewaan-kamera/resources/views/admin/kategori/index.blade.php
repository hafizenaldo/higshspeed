@extends('admin.layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Daftar Kategori</h3>S
                <p class="text-subtitle text-muted">Daftar kategori produk yang tersedia</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Daftar Kategori</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Data Kategori</h5>
            </div>
            <div class="card-body">

                {{-- [UPDATED] --}}
                <div class="d-flex justify-content-between align-items-center mb-3">
                    {{-- Tombol tambah --}}
                    <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm h-100 me-2">
                        + Tambah Kategori
                    </a>

                    {{-- Form search --}}
                    <form action="{{ route('kategori.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search"
                            value="{{ request('search') }}"
                            class="form-control form-control-sm"
                            placeholder="Cari kategori..."
                            style="width: 200px;"
                            oninput="this.form.submit()">
                    </form>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategoris as $kategori)
                        <tr>
                            <td>{{ $kategori->nama }}</td>
                            <td>
                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin hapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="text-center">Kategori tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection
