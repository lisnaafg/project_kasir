<div class="container mt-4">
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            @if($transaksiAktif)
                <button class="btn" wire:click='batalTransaksi'
                    style="background-color: #1e3670; color: white; padding: 10px 20px; border-radius: 8px;">
                    ❌ Batalkan Transaksi
                </button>
            @endif

            @if(!$transaksiAktif)
                <button class="btn" wire:click='transaksiBaru' 
                    style="background-color: #263847; color: white; padding: 10px 20px; border-radius: 8px;">
                    ➕ Transaksi Baru
                </button>
            @endif
            
            <button class="btn" wire:loading 
                style="background-color: #71869f; color: white; padding: 10px 20px; border-radius: 8px;">
                ⏳ Sedang Loading...
            </button>
        </div>
    </div>

    @if($transaksiAktif)
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0" style="border-left: 6px solid #263847; padding: 20px; font-size: 1.2rem; max-width: 1000px; width: 100%;">
                <div class="card-body">
                    <div class="card mt-3 p-3">
                        <h5 class="text-dark">👨‍💼 Kasir: {{ $transaksiAktif->kasir->name ?? 'Tidak Diketahui' }}</h5>
                    </div>
                    
                    <input type="text" class="form-control" placeholder="No. Invoice" wire:model.live="kode" style="font-size: 1rem; padding: 10px;">
                    
                    <table class="table mt-3 text-center">
                        <thead class="text-white" style="background-color: #71869f; font-size: 1rem;">
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Sub Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semuaProduk as $produk)
                            <tr style="background-color: #dfe2df; color: #263847; font-size: 1rem;">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $produk->produk->kode }}</td>
                                <td>{{ $produk->produk->nama }}</td>
                                <td>Rp {{ number_format($produk->produk->harga, 0, ',', '.') }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center">
                                        <button class="btn btn-sm btn-danger me-2" wire:click="kurangiJumlah({{ $produk->id }})">➖</button>
                                        <span class="px-2">{{ $produk->jumlah }}</span>
                                        <button class="btn btn-sm btn-success ms-2" wire:click="tambahJumlah({{ $produk->id }})">➕</button>
                                    </div>
                                </td>
                                <td>Rp {{ number_format($produk->produk->harga * $produk->jumlah, 0, ',', '.') }}</td>
                                <td>
                                    <button class="btn btn-sm" wire:click="hapusProduk({{ $produk->id }})" 
                                        style="background-color: #1e3670; color: white; font-size: 1rem; padding: 8px;">
                                        🗑 Hapus
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-lg border-0" style="border-left: 6px solid #263847; padding: 20px; font-size: 1.2rem; max-width: 1000px; width: 100%;">
                <div class="card-body">
                    <h5 class="card-title" style="color: #263847;">💰 Total Biaya</h5>
                    <div class="d-flex justify-content-between">
                        <span>Rp</span>
                        <span style="font-weight: bold;">{{ number_format($totalSemuaBelanja, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="card shadow-lg border-0 mt-3" style="border-left: 6px solid #71869f; padding: 20px; font-size: 1.2rem;">
                <div class="card-body">
                    <h5 class="card-title" style="color: #263847;">💵 Bayar</h5>
                    <input type="number" class="form-control" placeholder="Masukkan Nominal" wire:model.live="bayar" style="font-size: 1rem; padding: 10px;">
                </div>
            </div>

            <div class="card shadow-lg border-0 mt-3" style="border-left: 6px solid #1e3670; padding: 20px; font-size: 1rem;">
                <div class="card-body">
                    <h5 class="card-title" style="color: #263847;">💲 Kembalian</h5>
                    <div class="d-flex justify-content-between">
                        <span>Rp</span>
                        <span style="font-weight: bold;">{{ number_format($kembalian, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            @if ($bayar >= $totalSemuaBelanja)
                <button class="btn mt-3 w-100" wire:click="transaksiSelesai"
                    style="background-color: #71869f; color: white; padding: 15px; font-size: 1.2rem; border-radius: 8px;">
                    ✔ Bayar Sekarang
                </button>
            @elseif ($bayar > 0 && $bayar < $totalSemuaBelanja)
                <div class="alert alert-danger mt-3 text-center" style="background-color: #red; color: white; font-size: 1.2rem;">
                    ⚠ Uang kurang
                </div>

                <button class="btn btn-primary mt-3" onclick="printNota()">Cetak Nota</button>

            @endif
        </div>
    </div>
    @endif

    {{-- tambahan barcode --}}
    <video id="barcode-scanner"></video>
<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
<script>
    Quagga.init({
        inputStream: { name: "Live", type: "LiveStream", target: document.querySelector("#barcode-scanner") },
        decoder: { readers: ["code_128_reader", "ean_reader", "code_39_reader"] }
    }, function(err) {
        if (!err) {
            Quagga.start();
        }
    });

    Quagga.onDetected(function(result) {
        alert("Barcode Terdeteksi: " + result.codeResult.code);
    });
</script>

</div>
