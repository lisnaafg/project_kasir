<div class="container mt-5">
    <div class="card shadow-lg mx-auto p-4" style="max-width: 1000px; width: 190%; border-radius: 15px; background-color: #DFE2DF;">
        <div class="card-header text-white text-center fw-bold" style="background-color: #1E3670; border-radius: 10px 10px 0 0;">
            <h3 class="mb-0">Laporan Transaksi</h3>
        </div>
        <div class="card-body">
            <!-- Pilihan Filter -->
            <div class="row mb-4">
                <!-- Filter Per Bulan -->
                <div class="col-md-6">
                    <label class="fw-bold" style="color: #263847;">Laporan Per Bulan</label>
                    <div class="input-group">
                        <select wire:model="bulan" class="form-select">
                            @foreach (range(1, 12) as $m)
                                <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                </option>
                            @endforeach
                        </select>
                        <select wire:model="tahun" class="form-select">
                            @foreach (range(date('Y') - 5, date('Y')) as $y)
                                <option value="{{ $y }}">{{ $y }}</option>
                            @endforeach
                        </select>
                        <button class="btn text-white" style="background-color: #263847;" wire:click="filterPerBulan">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </div>

                <!-- Filter Per Rentang Tanggal -->
                <div class="col-md-6">
                    <label class="fw-bold" style="color: #263847;">Laporan Per Rentang Tanggal</label>
                    <div class="input-group">
                        <input type="date" wire:model="tanggalMulai" class="form-control">
                        <input type="date" wire:model="tanggalSelesai" class="form-control">
                        <button class="btn text-white" style="background-color: #263847;" wire:click="filterPerRentangTanggal">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </div>
            </div>

            <!-- Tombol Cetak -->
            <div class="d-flex justify-content-end mt-3">
                <a href="{{ url('/cetak') }}" target="_blank" class="btn text-white btn-lg" style="background-color: #1E3670;">
                    <i class="fas fa-print"></i> Cetak Laporan
                </a>
            </div>

            <!-- Tabel Laporan -->
            <div class="table-responsive mt-3">
                <table class="table table-bordered table-hover">
                    <thead class="text-white text-center" style="background-color: #71869F;">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>No. Inv.</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($semuaTransaksi as $transaksi)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ \Carbon\Carbon::parse($transaksi->created_at)->translatedFormat('d F Y') }}</td>
                                <td class="text-center">{{ $transaksi->kode }}</td>
                                <td class="text-end">Rp. {{ number_format($transaksi->total, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center" style="color: #263847;">Tidak ada transaksi</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
