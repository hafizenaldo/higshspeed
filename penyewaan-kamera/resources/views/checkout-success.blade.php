@extends('layouts.app') <!-- Ganti sesuai layout yang kamu gunakan -->

@section('title', 'Checkout Berhasil')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f9fafb;
    }

    .checkout-success {
        background: #ffffff;
        border-radius: 16px;
        padding: 50px 30px;
        max-width: 600px;
        margin: 100px auto;
        box-shadow: 0 20px 30px rgba(0, 0, 0, 0.05);
        text-align: center;
    }

    .checkout-success h1 {
        font-size: 3rem;
        color: #10b981;
        margin-bottom: 20px;
        font-weight: 700;
    }

    .checkout-success p {
        font-size: 1.1rem;
        color: #4b5563;
        margin-bottom: 10px;
    }

    .checkout-success .btn {
        padding: 12px 30px;
        font-size: 1rem;
        border-radius: 10px;
        font-weight: 600;
        background-color: #2563eb;
        border: none;
        color: white;
        transition: background-color 0.3s ease;
    }

    .checkout-success .btn:hover {
        background-color: #1e40af;
    }

    .success-icon {
        font-size: 60px;
        color: #10b981;
        margin-bottom: 20px;
    }
</style>

<div class="checkout-success">
    <div class="success-icon">✔</div>
    <h1>Checkout Berhasil!</h1>
    <p class="lead">Terima kasih telah melakukan pemesanan.</p>
    <p>Pesananmu akan segera kami proses.</p>

    <a href="{{ route('pemesanan.riwayat') }}" class="btn mt-4">
        Lihat Riwayat Pemesanan
    </a>
</div>
@endsection
