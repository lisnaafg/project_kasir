<div class="container mt-9">
    <div class="card shadow-lg mx-auto p-4" style="max-width: 1000px; width: 190%; border-radius: 15px;">
        <div class="card-header text-white text-center fw-bold" style="background-color: #db8fa6; border-radius: 10px 10px 0 0;">
            <div class="col-12">
                <button wire:click="pilihMenu('lihat')"
                    class="btn menu-btn {{ $pilihanMenu == 'lihat' ? 'active' : '' }}">📦 Semua Produk</button>

                <button wire:click="pilihMenu('tambah')"
                    class="btn menu-btn {{ $pilihanMenu == 'tambah' ? 'active' : '' }}">➕ Tambah Produk</button>

                <button wire:click="pilihMenu('excel')"
                    class="btn menu-btn {{ $pilihanMenu == 'excel' ? 'active' : '' }}">📥 Import Produk</button>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-20">
                {{-- Tampilkan Data Produk --}}
                @if($pilihanMenu == 'lihat')
                <div class="table-responsive shadow-lg p-3 bg-white rounded">
                    <table class="table table-hover w-10">
                            <thead class="table-dark">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kode Barcode</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($semuaProduk as $produk)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produk->nama }}</td>
                                        <td>
                                            {!! QrCode::size(80)->generate($produk->kode) !!}
                                            {{-- Untuk barcode gunakan ini --}}
                                            <img src="data:image/png;base64,{{ $produk->barcode }}" alt="barcode">

                                        </td>
                                        
                                        <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                        <td>{{ $produk->stok }}</td>
                                        <td>
                                            <button wire:click="pilihEdit({{ $produk->id }})" class="btn btn-warning btn-sm">✏️ Edit</button>
                                            <button wire:click="pilihHapus({{ $produk->id }})" class="btn btn-danger btn-sm">🗑 Hapus</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <button wire:loading class="btn btn-info">Loading...</button>
                    </div>

                {{-- Form Tambah Produk --}}
                @elseif ($pilihanMenu == 'tambah')
                    <div class="card shadow-lg p-3">
                        <div class="card-header bg-success text-white fw-bold">➕ Tambah Produk</div>
                        <div class="card-body">
                            <form wire:submit.prevent="simpan">
                                <label>Nama</label>
                                <input type="text" class="form-control" wire:model="nama">
                                @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                <br>

                                <label>Kode Barcode</label>
                                <input type="text" class="form-control" wire:model="kode">
                                @error('kode') <span class="text-danger">{{ $message }}</span> @enderror
                                <br>

                                <label>Harga</label>
                                <input type="number" class="form-control" wire:model="harga">
                                @error('harga') <span class="text-danger">{{ $message }}</span> @enderror
                                <br>

                                <label>Stok</label>
                                <input type="number" class="form-control" wire:model="stok">
                                @error('stok') <span class="text-danger">{{ $message }}</span> @enderror
                                <br>

                                <button type="submit" class="btn btn-success mt-3">✔ Simpan</button>
                            </form>
                        </div>
                    </div>

                {{-- Form Edit Produk --}}
                @elseif ($pilihanMenu == 'edit')
                    <div class="card shadow-lg p-3">
                        <div class="card-header bg-warning text-dark fw-bold">✏️ Edit Produk</div>
                        <div class="card-body">
                            <form wire:submit.prevent="simpanEdit">
                                <label>Nama</label>
                                <input type="text" class="form-control" wire:model="nama">
                                @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                                <br>

                                <label>Kode Barcode</label>
                                <input type="text" class="form-control" wire:model="kode">
                                @error('kode') <span class="text-danger">{{ $message }}</span> @enderror
                                <br>

                                <label>Harga</label>
                                <input type="number" class="form-control" wire:model="harga">
                                @error('harga') <span class="text-danger">{{ $message }}</span> @enderror
                                <br>

                                <label>Stok</label>
                                <input type="number" class="form-control" wire:model="stok">
                                @error('stok') <span class="text-danger">{{ $message }}</span> @enderror
                                <br>

                                <button type="submit" class="btn btn-warning mt-3">✔ Simpan</button>
                                <button type="button" wire:click="batal" class="btn btn-secondary mt-3">❌ Batal</button>
                            </form>
                        </div>
                    </div>

                {{-- Konfirmasi Hapus Produk --}}
                @elseif ($pilihanMenu == 'hapus')
                    <div class="card shadow-lg p-3 border-danger" style="background-color: rgb(161, 175, 241)">
                        <div class="card-header bg-danger text-white fw-bold">🗑 Hapus Produk</div>
                        <div class="card-body">
                            @if($produkTerpilih)
                                <p>Anda yakin ingin menghapus produk ini?</p>
                                <p class="fw-bold">Nama: {{ $produkTerpilih->nama }}</p>
                                <button class="btn btn-danger" wire:click="hapus">HAPUS</button>
                                <button class="btn btn-secondary" wire:click="batal">BATAL</button>
                            @else
                                <p class="text-danger">Tidak ada produk yang dipilih.</p>
                            @endif
                        </div>
                    </div>

                {{-- Form Import Excel --}}
                @elseif ($pilihanMenu == 'excel')
                    <div class="card shadow-lg p-3">
                        <div class="card-header bg-primary text-white fw-bold">📥 Import Produk</div>
                        <div class="card-body">
                            <form wire:submit.prevent="imporExcel">
                                <input type="file" class="form-control" wire:model="fileExcel">
                                <br>
                                <button class="btn btn-primary" type="submit">Kirim</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
