<div class="container mt-4">
    <div class="card shadow-lg mx-auto p-4" style="max-width: 1000px; width: 190%; border-radius: 15px;">
        <div class="card-header text-white text-center fw-bold" style="background-color: #db8fa6; border-radius: 10px 10px 0 0;">
            <div class="col-12">
                <button wire:click="pilihMenu('lihat')"
                    class="btn menu-btn {{ $pilihanMenu == 'lihat' ? 'active' : '' }}">👤 Semua Pengguna</button>

                <button wire:click="pilihMenu('tambah')"
                    class="btn menu-btn {{ $pilihanMenu == 'tambah' ? 'active' : '' }}">➕ Tambah Pengguna</button>
            </div>
        </div>

        <div class="row my-3">
            <div class="col-12">
                @if($pilihanMenu == 'lihat')
                <div class="table-responsive shadow-lg p-3 bg-white rounded">
                    <table class="table table-hover w-10">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Peran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semuaPengguna as $index => $pengguna)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $pengguna->name }}</td>
                                    <td>{{ $pengguna->email }}</td>
                                    <td style="text-transform: capitalize; text-align: center;">{{ $pengguna->role }}</td>
                                    <td>
                                        <button wire:click="pilihEdit({{ $pengguna->id }})" class="btn btn-warning btn-sm">✏️ Edit</button>
                                        <button wire:click="pilihHapus({{ $pengguna->id }})" class="btn btn-danger btn-sm">🗑 Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                @elseif ($pilihanMenu == 'tambah' || $pilihanMenu == 'edit')
                <div class="card shadow-lg p-3">
                    <div class="card-header bg-success text-white fw-bold">{{ $pilihanMenu == 'tambah' ? '➕ Tambah Pengguna' : '✏️ Edit Pengguna' }}</div>
                    <div class="card-body">
                        <form wire:submit.prevent="{{ $pilihanMenu == 'tambah' ? 'simpan' : 'simpanEdit' }}">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" wire:model="nama">
                            @error('nama') <span class="text-danger">{{ $message }}</span> @enderror
                            <br>

                            <label for="">Email</label>
                            <input type="email" class="form-control" wire:model="email">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            <br>

                            <label for="">Password</label>
                            <input type="password" class="form-control" wire:model="password">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                            <br>

                            <label for="">Peran</label>
                            <select class="form-control" wire:model="peran">
                                <option>- Pilih Peran -</option>
                                <option value="admin">Admin</option>
                                <option value="kasir">Kasir</option>
                                <option value="manajer">Manajer</option>
                            </select>
                            @error('peran') <span class="text-danger">{{ $message }}</span> @enderror
                            <br>

                            <button type="submit" class="btn btn-success mt-3">✔ Simpan</button>
                            <button type="button" wire:click='batal' class="btn btn-secondary mt-3">❌ Batal</button>
                        </form>
                    </div>
                </div>

                @elseif ($pilihanMenu == 'hapus')
                <div class="card shadow-lg p-3 border-danger" style="background-color: rgb(161, 175, 241)">
                    <div class="card-header bg-danger text-white fw-bold">🗑 Hapus Pengguna</div>
                    <div class="card-body">
                        @if($penggunaTerpilih)
                            <p>Anda yakin ingin menghapus pengguna ini?</p>
                            <p class="fw-bold">Nama: {{ $penggunaTerpilih->name }}</p>
                            <button class="btn btn-danger" wire:click="hapus">HAPUS</button>
                            <button class="btn btn-secondary" wire:click="batal">BATAL</button>
                        @else
                            <p class="text-danger">Tidak ada pengguna yang dipilih.</p>
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
