<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>

    <!-- CSS untuk cetak -->
    <style>
        @media print {
            body {
                font-family: Arial, sans-serif;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }

            th {
                background-color: #f2f2f2;
            }

            /* Agar elemen selain tabel tidak ikut tercetak */
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <h2 style="text-align: center;">Laporan Transaksi</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>No. Inv.</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($semuaTransaksi as $transaksi)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $transaksi->created_at->format('d-m-Y H:i') }}</td>
                    <td>{{ $transaksi->kode }}</td>
                    <td>Rp. {{ number_format($transaksi->total, 2, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
