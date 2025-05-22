@component('mail::message')
# 🧾 Invoice Pembayaran

Terima kasih, {{ $pemesanan->user->name }}! Pembayaran Anda telah **berhasil diterima**.

### 📌 Rincian Pemesanan:
- **No Transaksi:** {{ $pemesanan->id }}
- **Total Pembayaran:** Rp {{ number_format($pemesanan->total, 0, ',', '.') }}
- **Tanggal Pengambilan:** {{ \Carbon\Carbon::parse($pemesanan->tanggal_ambil)->translatedFormat('d F Y H:i') }}
- **Tanggal Pengembalian:** {{ \Carbon\Carbon::parse($pemesanan->tanggal_kembali)->translatedFormat('d F Y H:i') }}
- **Status Pembayaran:** {{ ucfirst($pemesanan->status_pembayaran) }}

@component('mail::button', ['url' => url('/')])
Lihat Detail Pemesanan
@endcomponent

Terima kasih telah mempercayai layanan kami.

Salam hangat,
{{ config('app.name') }}
@endcomponent
