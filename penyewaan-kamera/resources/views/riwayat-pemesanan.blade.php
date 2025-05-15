@extends('layouts.app')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9fafb;
    }

    .card-history {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        background-color: #ffffff;
    }

    .card-header {
        background-color: #f3f4f6;
        padding: 20px;
        font-weight: 600;
        font-size: 1.1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .card-header div {
        color: #374151;
    }

    .table th {
        background-color: #f9fafb;
        color: #374151;
        font-weight: 600;
    }

    .table td,
    .table th {
        vertical-align: middle;
        text-align: center;
        padding: 14px;
        font-size: 0.95rem;
    }

    .btn-pay {
        background-color: #2563eb;
        color: white;
        font-size: 0.9rem;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        transition: background-color 0.3s ease;
        border: none;
    }

    .btn-pay:hover {
        background-color: #1e40af;
    }

    .badge-status {
        padding: 6px 14px;
        font-size: 0.85rem;
        border-radius: 50px;
        font-weight: 600;
        display: inline-block;
        text-transform: capitalize;
    }

    .badge-success {
        background-color: #dcfce7;
        color: #15803d;
    }

    .badge-warning {
        background-color: #fef9c3;
        color: #92400e;
    }

    .badge-danger {
        background-color: #fee2e2;
        color: #b91c1c;
    }

    .text-center h2 {
        font-weight: 700;
        font-size: 2rem;
        color: #111827;
    }

    .alert-info {
        background-color: #eff6ff;
        color: #1e3a8a;
        padding: 16px;
        border-radius: 8px;
    }
</style>

<div class="container" style="margin-top: 100px;">
    <h2 class="text-center mb-5"> Riwayat Pemesanan Anda</h2>

    @forelse($pemesanans as $pemesanan)
        <div class="card mb-5 card-history">
            <div class="card-header d-flex justify-content-between flex-wrap">
                <div><strong>ID Pemesanan:</strong> #{{ $pemesanan->id }}</div>
                <div><strong>Tanggal:</strong> {{ $pemesanan->created_at->format('d M Y H:i') }}</div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Waktu Pengambilan</th>
                                <th>Waktu Pengembalian</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pemesanan->detailpemesanans as $index => $detail)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $detail->produk->nama_produk ?? 'Tidak Diketahui' }}</td>
                                <td>{{ $detail->jumlah_item }}</td>
                                <td>{{ \Carbon\Carbon::parse($detail->waktu_pengambilan)->format('d-m-Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($detail->waktu_pengembalian)->format('d-m-Y H:i') }}</td>
                                <td>Rp{{ number_format($detail->harga, 0, ',', '.') }}</td>
                                <td>Rp{{ number_format($detail->sub_total, 0, ',', '.') }}</td>

                                @if ($loop->first)
                                <td rowspan="{{ count($pemesanan->detailpemesanans) }}" class="align-middle">
                                    @php
                                        $status = strtolower($pemesanan->status_pembayaran);
                                        $badgeClass = in_array($status, ['settlement', 'paid']) ? 'badge-success'
                                                    : ($status === 'pending' ? 'badge-warning' : 'badge-danger');

                                    @endphp

                                    <span class="badge-status {{ $badgeClass }}">
                                        {{ $status }}
                                    </span>

                                    @if($status === 'pending')
                                        <button
                                            class="btn-pay mt-2 pay-button"
                                            data-snap-token="{{ $pemesanan->snap_token }}">
                                            💳 Bayar Sekarang
                                        </button>
                                    @endif
                                </td>
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6" class="text-end">Total</th>
                                <th colspan="2">Rp{{ number_format($pemesanan->total, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">⚠️ Tidak ada riwayat pemesanan.</div>
    @endforelse
</div>
@endsection

@section('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.pay-button').forEach(button => {
            button.addEventListener('click', function () {
                const snapToken = this.dataset.snapToken;

                if (!snapToken || snapToken === 'null') {
                    alert("Token pembayaran tidak tersedia.");
                    return;
                }

                snap.pay(snapToken, {
                    onSuccess: function(result) {
                        fetch('{{ route("checkout.updateStatus") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                order_id: result.order_id,
                                transaction_status: result.transaction_status
                            })
                        })
                        .then(res => res.json())
                        .then(() => {
                            alert('Pembayaran berhasil!');
                            window.location.reload();
                        })
                        .catch(() => {
                            alert('Gagal update status pembayaran.');
                        });
                    },
                    ,
                    onPending: function(result) {
                        alert('Pembayaran sedang diproses.');
                    },
                    onError: function(result) {
                        alert('Terjadi kesalahan dalam pembayaran.');
                    },
                    onClose: function() {
                        alert('Anda menutup popup pembayaran.');
                    }
                });
            });
        });
    });
</script>
@endsection
