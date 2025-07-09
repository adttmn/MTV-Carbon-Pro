<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan User</title>
</head>

<body>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 20px;
            background: #f5f5f5;
        }

        .header {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .header h2 {
            color: #333;
            margin: 0;
            font-size: 24px;
        }

        .header p {
            color: #666;
            margin: 10px 0 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        table th {
            background: #4a90e2;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 500;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        table tr:hover {
            background: #f8f9fa;
        }

        .status-active {
            color: #28a745;
            font-weight: 500;
        }

        .status-inactive {
            color: #dc3545;
            font-weight: 500;
        }

        @media print {
            body {
                background: #fff;
            }

            .header {
                box-shadow: none;
            }

            table {
                box-shadow: none;
            }

            table th {
                background-color: #4a90e2 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .status-active {
                color: #28a745 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .status-inactive {
                color: #dc3545 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>

    <div class="header">
        <h2>{{ $judul }}</h2>
        <p>Periode: {{ $tanggalAwal }} s/d {{ $tanggalAkhir }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama</th>
                <th width="30%">Email</th>
                <th width="20%">Role</th>
                <th width="20%">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cetak as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->email }}</td>
                    <td>
                        @if ($row->role == 1)
                            <span class="badge badge-primary">Super Admin</span>
                        @elseif($row->role == 2)
                            <span class="badge badge-info">Admin</span>
                        @elseif($row->role == 3)
                            <span class="badge badge-secondary">Customer</span>
                        @endif
                    </td>
                    <td>
                        @if ($row->status == 1)
                            <span class="status-active">Aktif</span>
                        @elseif($row->status == 0)
                            <span class="status-inactive">NonAktif</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        window.onload = function() {
            printStruk();
        }

        function printStruk() {
            window.print();
        }
    </script>
</body>

</html>
