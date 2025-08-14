@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Transaksi Manual</h1>

    <form action="{{ route('keuangan.update', $keuangan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $keuangan->tanggal->format('Y-m-d') }}" required>
        </div>

        <div class="mb-3">
            <label>Jenis Transaksi</label>
            <select name="jenis_transaksi" class="form-control" required>
                <option value="pemasukan" {{ $keuangan->jenis_transaksi == 'pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                <option value="pengeluaran" {{ $keuangan->jenis_transaksi == 'pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control" value="{{ $keuangan->keterangan }}">
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="jumlah" class="form-control" step="0.01" value="{{ $keuangan->jumlah }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('keuangan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
