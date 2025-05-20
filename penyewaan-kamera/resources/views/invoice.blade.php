    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <title>Invoice #{{ $pemesanan->id }}</title>
        <style>
            body { font-family: 'Segoe UI', sans-serif; background-color: #f9fafb; padding: 30px; }
            table { width: 100%; border-collapse: collapse; margin-top: 30px; background-color: #fff; }
            th, td { padding: 12px 16px; text-align: left; border-bottom: 1px solid #e5e7eb; }
            th { background-color: #f3f4f6; font-weight: 600; color: #374151; }
            td { color: #374151; font-size: 15px; }
            .total-row td { font-weight: 600; background-color: #f9fafb; border-top: 2px solid #e5e7eb; }
            .status-paid { background-color: #d1fae5; color: #047857; padding: 5px 10px; border-radius: 9999px; display: inline-block; font-weight: 600; font-size: 14px; }
            .text-right { text-align: right; }
        </style>
    </head>
    <body>

        <h2>🧾 Invoice Pemesanan #{{ $pemesanan->id }}</h2>
        <p><strong>Tanggal Pemesanan:</strong> {{ $pemesanan->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>Nama Pengguna:</strong> {{ $pemesanan->user->name }}</p>
        <p><strong>Email Pengguna:</strong> {{ $pemesanan->user->email }}</p>

        <table>
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
                @foreach ($pemesanan->detail_pemesanans as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->produk->nama }}</td>
                        <td>{{ $item->jumlah_item }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->waktu_pengambilan)->format('d-m-Y H:i') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->waktu_pengembalian)->format('d-m-Y H:i') }}</td>
                        <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                        <td>Rp{{ number_format($item->sub_total, 0, ',', '.') }}</td>
                        <td>
                            @if($pemesanan->status_pembayaran === 'paid')
                                <span class="status-paid">Paid</span>
                            @else
                                <span class="status-unpaid">{{ ucfirst($pemesanan->status_pembayaran) }}</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="6"></td>
                    <td>Total</td>
                    <td>Rp{{ number_format($pemesanan->total, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>

    </body>
    </html>
