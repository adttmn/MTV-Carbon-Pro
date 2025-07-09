<style>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    body {
        font-family: 'Poppins', sans-serif;
        background: #f8f9fa;
        color: #333;
        line-height: 1.6;
    }

    .invoice-container {
        max-width: 1000px;
        margin: 20px auto;
        padding: 30px;
        background: #fff;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
        border-radius: 10px;
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #eee;
    }

    .invoice-header img {
        max-width: 150px;
    }

    .invoice-title {
        color: #2c3e50;
        margin: 0;
    }

    .invoice-date {
        color: #7f8c8d;
        font-size: 0.9em;
    }

    .info-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 30px;
    }

    .info-card {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .info-card h5 {
        color: #2c3e50;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .info-card address {
        margin: 0;
        font-style: normal;
        color: #555;
    }

    .products-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        margin-bottom: 30px;
    }

    .products-table th {
        background: #2c3e50;
        color: white;
        padding: 12px;
        text-align: left;
    }

    .products-table td {
        padding: 12px;
        border-bottom: 1px solid #eee;
    }

    .products-table tr:hover {
        background: #f8f9fa;
    }

    .product-details {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .product-details li {
        color: #666;
        font-size: 0.9em;
    }

    .total-section {
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .grand-total {
        font-size: 1.2em;
        font-weight: 600;
        color: #2c3e50;
        border-top: 2px solid #eee;
        padding-top: 10px;
        margin-top: 10px;
    }

    @media print {
        body {
            background: white;
        }
        .invoice-container {
            box-shadow: none;
            margin: 0;
            padding: 20px;
        }
        .products-table th {
            background-color: #2c3e50 !important;
            color: white !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .info-card {
            background-color: #f8f9fa !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .total-section {
            background-color: #f8f9fa !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .invoice-title {
            color: #2c3e50 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .grand-total {
            color: #2c3e50 !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>

<div class="invoice-container">
    <div class="invoice-header">
        <img src="{{ asset('image/logo.png') }}" alt="Logo">
        <div>
            <h2 class="invoice-title">Invoice #{{ $order->id }}</h2>
            <p class="invoice-date">{{ $order->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <div class="info-section">
        <div class="info-card">
            <h5>Informasi Pelanggan</h5>
            <address>
                <strong>{{ $order->customer->user->nama }}</strong><br>
                {{ $order->customer->email }}<br>
                {{ $order->customer->hp }}<br>
                {!! $order->alamat !!}<br>
                Kode Pos: {{ $order->pos }}
            </address>
        </div>

        <div class="info-card">
            <h5>Informasi Pengiriman</h5>
            <address>
                @if ($order->noresi)
                    <strong>No. Resi:</strong> {{ $order->noresi }}<br>
                @else
                    <strong>No. Resi:</strong> <span style="color: #e74c3c;">Dalam proses</span><br>
                @endif
                <strong>Kurir:</strong> {{ $order->kurir }}<br>
                <strong>Layanan:</strong> {{ $order->layanan_ongkir }}<br>
                <strong>Estimasi:</strong> {{ $order->estimasi_ongkir }} Hari<br>
                <strong>Berat:</strong> {{ $order->total_berat }} Gram
            </address>
        </div>
    </div>

    <table class="products-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalHarga = 0;
                $totalBerat = 0;
            @endphp
            @foreach ($order->orderItems as $item)
                @php
                    $totalHarga += $item->harga * $item->quantity;
                    $totalBerat += $item->produk->berat * $item->quantity;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <strong>{{ $item->produk->nama_produk }}</strong>
                        <ul class="product-details">
                            <li>Kategori: {{ $item->produk->kategori->nama_kategori }}</li>
                            <li>Berat: {{ $item->produk->berat }} Gram</li>
                            <li>Stok: {{ $item->produk->stok }} Unit</li>
                        </ul>
                    </td>
                    <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>Rp. {{ number_format($item->harga * $item->quantity, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <div class="total-row">
            <span>Subtotal</span>
            <span>Rp. {{ number_format($totalHarga, 0, ',', '.') }}</span>
        </div>
        <div class="total-row">
            <span>Ongkos Kirim</span>
            <span>Rp. {{ number_format($order->biaya_ongkir, 0, ',', '.') }}</span>
        </div>
        <div class="total-row grand-total">
            <span>Total Bayar</span>
            <span>Rp. {{ number_format($totalHarga + $order->biaya_ongkir, 0, ',', '.') }}</span>
        </div>
    </div>
</div>

<script>
    window.onload = function() {
        printStruk();
    }

    function printStruk() {
        window.print();
    }
</script>