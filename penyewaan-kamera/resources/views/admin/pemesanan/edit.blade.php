@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Edit Status Pembayaran</h2>

    <form action="{{ route('pemesanan.update', $pemesanan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mt-3">
            <label>Status Pembayaran</label>
            <select name="status_pembayaran" class="form-control">
                <option value="pending" {{ $pemesanan->status_pembayaran == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ $pemesanan->status_pembayaran == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="expired" {{ $pemesanan->status_pembayaran == 'expired' ? 'selected' : '' }}>Expired</option>
                <option value="canceled" {{ $pemesanan->status_pembayaran == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Update</button>
        <a href="{{ route('pemesanan.index') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
@endsection
