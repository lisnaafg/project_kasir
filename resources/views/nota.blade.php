<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { text-align: center; font-size: 20px; font-weight: bold; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid black; padding: 8px; text-align: left; }
        .footer { margin-top: 20px; text-align: center; font-size: 12px; }
        .total-container { text-align: right; font-size: 16px; font-weight: bold; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="header">Nota Pembelian</div>
    <div class="header">TOKO LIS' Modest Wear</div>

    <p><strong>No Invoice:</strong> {{ $transaksi->kode }}</p>
    <p><strong>Nama Kasir:</strong> {{ $transaksi->kasir?->name ?? 'Tidak Diketahui' }}</p>
    <p><strong>Tanggal:</strong> {{ $transaksi->created_at->format('d-m-Y') }}</p>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi->items as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->produk->nama }}</td>
                <td>Rp{{ number_format($item->produk->harga, 0, ',', '.') }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>Rp{{ number_format($item->produk->harga * $item->jumlah, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-container">
        <p><strong>Total Pembayaran:</strong> Rp{{ number_format($transaksi->total, 0, ',', '.') }}</p>
    </div>

    <div class="footer">Terima kasih telah berbelanja di <strong>LIS' Modest Wear!</strong></div>
</body>
</html>
