@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Transaksi Manual</h1>

    <form action="{{ route('keuangan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal') }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Transaksi</label>
            <select name="jenis_transaksi" class="form-control" required>
                <option value="">-- Pilih --</option>
                <option value="pemasukan" {{ old('jenis_transaksi') == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                <option value="pengeluaran" {{ old('jenis_transaksi') == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan') }}">
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" step="0.01" value="{{ old('jumlah') }}" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('keuangan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
