<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $pemesanan->id }}</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #ffffff;
            color: #374151;
            padding: 40px;
            font-size: 14px;
        }

        h1 {
            color: #111827;
            font-size: 24px;
            margin-bottom: 5px;
        }

        p {
            margin: 2px 0;
        }

        .header {
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px 12px;
            border: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background-color: #f3f4f6;
            color: #1f2937;
            font-weight: 600;
        }

        td {
            font-size: 13px;
        }

        .total-row td {
            font-weight: 600;
            background-color: #f9fafb;
        }

        .status-paid {
            background-color: #d1fae5;
            color: #047857;
            padding: 4px 8px;
            border-radius: 12px;
            display: inline-block;
            font-weight: 600;
        }

        .status-unpaid {
            background-color: #fee2e2;
            color: #b91c1c;
            padding: 4px 8px;
            border-radius: 12px;
            display: inline-block;
            font-weight: 600;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1> Invoice Pemesanan</h1>
        <p><strong>ID Pemesanan:</strong> #{{ $pemesanan->id }}</p>
        <p><strong>Tanggal:</strong> {{ $pemesanan->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>Nama Pelanggan:</strong> {{ $pemesanan->user->name }}</p>
        <p><strong>Email:</strong> {{ $pemesanan->user->email }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Waktu Pengambilan</th>
                <th>Waktu Pengembalian</th>
                <th>Harga / Hari</th>
                <th>Subtotal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemesanan->detailpemesanans as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->produk->nama_produk ?? '-' }}</td>
                    <td class="text-center">{{ $item->jumlah_item }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->waktu_pengambilan)->format('d-m-Y H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->waktu_pengembalian)->format('d-m-Y H:i') }}</td>
                    <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>Rp{{ number_format($item->sub_total, 0, ',', '.') }}</td>
                    <td class="text-center">
                        @if($pemesanan->status_pembayaran === 'paid')
                            <span class="status-paid">Paid</span>
                        @else
                            <span class="status-unpaid">{{ ucfirst($pemesanan->status_pembayaran) }}</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="6" class="text-right">Total</td>
                <td colspan="2">Rp{{ number_format($pemesanan->total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>
