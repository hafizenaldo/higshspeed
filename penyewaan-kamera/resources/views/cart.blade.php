@extends('layouts.app')

@section('content')

<style>
    .table-shopping-cart th,
    .table-shopping-cart td {
        padding: 15px 10px;
        text-align: left;
        vertical-align: middle;
    }

    .table-shopping-cart th {
        font-weight: 600;
        white-space: nowrap;
    }

    .how-itemcart1 img {
        max-width: 80px;
        height: auto;
    }
</style>

<div class="bg0 p-t-75 p-b-85">

    <div class="container" style="margin-top: 100px;">
        <h2 class="text-center mb-5">Keranjang Anda</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($keranjang->isEmpty())
            <p>Keranjang kamu kosong.</p>
            <a href="{{ route('produk.index') }}" class="btn btn-primary mt-3">Lihat Produk</a>
        @else
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-1">gambar</th>
                                <th class="column-2">Nama Produk</th>
                                <th class="column-3">Harga</th>
                                <th class="column-4">Jumlah </th>
                                <th class="column-5">Waktu Sewa</th>
                                <th class="column-6">Total</th>
                            </tr>

                            @foreach($keranjang as $item)
                            @php
                                $waktuAmbil = \Carbon\Carbon::parse($item->waktu_pengambilan);
                                $waktuKembali = \Carbon\Carbon::parse($item->waktu_pengembalian);
                                $jumlahHari = $waktuAmbil->diffInDays($waktuKembali);
                                if ($jumlahHari === 0) $jumlahHari = 1;
                            @endphp
                            <tr class="table_row">
                                <td class="column-1">
                                    <div class="how-itemcart1">
                                        <img src="{{ asset('storage/' . $item->produk->foto) }}" alt="{{ $item->produk->nama_produk }}">
                                    </div>
                                </td>
                                <td class="column-2">
                                    {{ $item->produk->nama_produk }}<br>
                                    <small>
                                        Ambil: {{ $waktuAmbil->format('d-m-Y H:i') }} <br>
                                        Kembali: {{ $waktuKembali->format('d-m-Y H:i') }}
                                    </small>

                                    <form action="{{ route('keranjang.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>

                                </td>
                                <td class="column-3"><span style="white-space: nowrap;">Rp {{ number_format($item->produk->harga, 0, ',', '.') }}</span></td>
                                <td class="column-4">{{ $item->jumlah_item }}</td>
                                <td class="column-5">{{ $jumlahHari }} hari</td>
                                <td class="column-6">Rp {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <!-- Total -->
            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>

                    @php
                        $total = $keranjang->sum('sub_total');
                    @endphp

                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">
                                Subtotal:
                            </span>
                        </div>

                        <div class="size-209">
                            <span class="mtext-110 cl2">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <div class="flex-w flex-t p-t-27 p-b-33">
                        <div class="size-208">
                            <span class="mtext-101 cl2">
                                Total:
                            </span>
                        </div>

                        <div class="size-209 p-t-1">
                            <span class="mtext-110 cl2">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>

                    </div>
                    <a href="{{ route('checkout.index') }}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        Checkout
                    </a>
                     {{-- <form action="{{ route('checkout.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                checkout
                            </button>
                        </form> --}}

                </div>
            </div>
        </div>

        <!-- TOMBOL KEMBALI -->
        <div class="text-left mt-4">
            <a href="{{ url('/produk') }}" class="btn btn-outline-secondary">
                Kembali ke Halaman Produk
            </a>
        </div>
        @endif
    </div>
</div>

@endsection
