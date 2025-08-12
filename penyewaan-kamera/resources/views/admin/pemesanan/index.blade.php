@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary fw-bold">Data Pemesanan</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Info Showing entries --}}
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <div class="text-muted fst-italic small">
            {{-- Contoh: Showing 1 to 10 of 50 entries --}}
            Showing
            <strong>{{ $pemesanans->firstItem() }}</strong> to
            <strong>{{ $pemesanans->lastItem() }}</strong> of
            <strong>{{ $pemesanans->total() }}</strong> entries
        </div>
        {{-- Kamu bisa taruh tombol tambah data atau filter di sini nanti --}}
    </div>

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama User</th>
                    <th>Total</th>
                    <th>Status Pembayaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pemesanans as $pemesanan)
                    <tr>
                        <td>{{ $pemesanan->id }}</td>
                        <td>{{ $pemesanan->user->name ?? '-' }}</td>
                        <td>Rp {{ number_format($pemesanan->total, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $status = strtolower($pemesanan->status_pembayaran);
                            @endphp

                            @if($status == 'lunas' || $status == 'paid')
                                <span class="badge bg-success">{{ $pemesanan->status_pembayaran }}</span>
                            @elseif($status == 'pending')
                                <span class="badge bg-warning text-dark">{{ $pemesanan->status_pembayaran }}</span>
                            @else
                                <span class="badge bg-secondary">{{ $pemesanan->status_pembayaran }}</span>
                            @endif
                        </td>

                        <td>
                            <a href="{{ route('pemesanan.show', $pemesanan->id) }}" class="btn btn-info btn-sm" title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('pemesanan.edit', $pemesanan->id) }}" class="btn btn-warning btn-sm" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('pemesanan.destroy', $pemesanan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination dengan styling Bootstrap 5 --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $pemesanans->onEachSide(1)->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
