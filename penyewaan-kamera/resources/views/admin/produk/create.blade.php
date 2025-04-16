@extends('admin.layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Tambah Produk</h3>
                <p class="text-subtitle text-muted">Form untuk menambahkan produk baru</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Daftar Produk</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Produk</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Form Tambah Produk</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_produk" class="form-label">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="kategori_id" class="form-label">Kategori</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="stok" class="form-label">Stok</label>
                        <input type="number" name="stok" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Produk</label>
                        <input type="file" name="foto" class="form-control">
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
