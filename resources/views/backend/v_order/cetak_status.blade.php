<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Order Berdasarkan Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            color: #333;
            font-size: 18px;
        }

        .header p {
            margin: 5px 0;
            color: #666;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .info-section table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-section td {
            padding: 5px;
            vertical-align: top;
        }

        .info-section td:first-child {
            font-weight: bold;
            width: 150px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .total-section {
            margin-top: 20px;
            text-align: right;
        }

        .total-section table {
            width: auto;
            margin-left: auto;
        }

        .total-section td {
            padding: 5px 15px;
            border: none;
        }

        .total-section td:first-child {
            font-weight: bold;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #666;
            font-style: italic;
        }

        @media print {
            body {
                margin: 0;
                padding: 20px;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN ORDER BERDASARKAN STATUS</h1>
        <p>MTV Carbon Pro</p>
        <p>Tanggal Cetak: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <div class="info-section">
        <table>
            <tr>
                <td>Status Order:</td>
                <td>{{ ucfirst($status) }}</td>
            </tr>
            @if ($tanggalAwal && $tanggalAkhir)
                <tr>
                    <td>Periode:</td>
                    <td>{{ date('d/m/Y', strtotime($tanggalAwal)) }} - {{ date('d/m/Y', strtotime($tanggalAkhir)) }}
                    </td>
                </tr>
            @endif
            <tr>
                <td>Total Order:</td>
                <td>{{ $totalOrder }} order</td>
            </tr>
        </table>
    </div>

    @if ($orders->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Tanggal Order</th>
                    <th>Status</th>
                    <th>Total Harga</th>
                    <th>Kurir</th>
                    <th>No. Resi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>#{{ $order->id }}</td>
                        <td>{{ $order->customer->user->nama ?? 'N/A' }}</td>
                        <td>{{ date('d/m/Y H:i', strtotime($order->created_at)) }}</td>
                        <td>
                            @switch($order->status)
                                @case('pending')
                                    <span style="color: #ffc107;">Pending</span>
                                @break

                                @case('Paid')
                                    <span style="color: #28a745;">Dibayar</span>
                                @break

                                @case('processing')
                                    <span style="color: #17a2b8;">Processing</span>
                                @break

                                @case('shipped')
                                    <span style="color: #007bff;">Shipped</span>
                                @break

                                @case('delivered')
                                    <span style="color: #28a745;">Delivered</span>
                                @break

                                @case('cancelled')
                                    <span style="color: #dc3545;">Cancelled</span>
                                @break

                                @default
                                    {{ $order->status }}
                            @endswitch
                        </td>
                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td>{{ $order->kurir ?? '-' }}</td>
                        <td>{{ $order->noresi ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <table>
                <tr>
                    <td>Total Order:</td>
                    <td>{{ $totalOrder }} order</td>
                </tr>
                <tr>
                    <td>Total Pendapatan:</td>
                    <td>Rp {{ number_format($totalHarga, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    @else
        <div class="no-data">
            <p>Tidak ada data order dengan status "{{ ucfirst($status) }}"
                @if ($tanggalAwal && $tanggalAkhir)
                    untuk periode {{ date('d/m/Y', strtotime($tanggalAwal)) }} -
                    {{ date('d/m/Y', strtotime($tanggalAkhir)) }}
                @endif
            </p>
        </div>
    @endif

    <div class="no-print" style="margin-top: 30px; text-align: center;">
        <button onclick="window.print()"
            style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Cetak Laporan
        </button>
        <button onclick="window.close()"
            style="padding: 10px 20px; background-color: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; margin-left: 10px;">
            Tutup
        </button>
    </div>
</body>

</html>
