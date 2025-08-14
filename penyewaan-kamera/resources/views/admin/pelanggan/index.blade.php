@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow-lg border-0 rounded-3 overflow-hidden">
        {{-- Header dengan gradient --}}
        <div class="card-header text-white d-flex justify-content-between align-items-center"
             style="background: linear-gradient(90deg, #4e73df, #224abe);">
            <h5 class="mb-0 fw-bold">
                <i class="bi bi-people-fill me-2"></i> Daftar Akun Pelanggan
            </h5>
            <span class="badge bg-light text-dark">
                Total: {{ $pelanggan->count() }} pelanggan
            </span>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead style="background-color: #f8f9fc;">
                        <tr class="text-secondary fw-bold">
                            <th style="width: 40px;"></th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pelanggan as $p)
                        <tr class="border-bottom hover-row">
                            {{-- Avatar Inisial Nama --}}
                            <td>
                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                     style="width: 35px; height: 35px; font-size: 14px;">
                                    {{ strtoupper(substr($p->name, 0, 1)) }}
                                </div>
                            </td>
                            <td class="fw-semibold">{{ $p->name }}</td>
                            <td class="text-muted">{{ $p->email }}</td>
                            <td>{{ $p->nohp ?? '-' }}</td>
                            <td>{{ $p->created_at->format('d M Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                <i class="bi bi-exclamation-circle me-2"></i> Tidak ada data pelanggan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Efek hover custom --}}
<style>
    .hover-row:hover {
        background-color: #f1f5ff;
        transition: 0.2s ease-in-out;
    }
</style>
@endsection
