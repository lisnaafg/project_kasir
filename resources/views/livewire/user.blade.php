<div class="container-fluid" style="width: 100%; height: 100vh; padding: 20px;">
    <div class="row my-3">
        <div class="col-12">
            <button wire:click="pilihMenu('lihat')"
                class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}"
                style="background-color: #DC586D; color: white; border: none;">Semua Pengguna</button>

            <button wire:click="pilihMenu('tambah')"
                class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}"
                style="background-color: #A33757; color: white; border: none;">Tambah Pengguna</button>
        </div>
    </div>

    <div class="row my-8">
        <div class="col-12">
            @if($pilihanMenu == 'lihat')
                <div class="table-responsive" style="overflow-x: auto; width: 150%;">
                    <table class="table table-bordered table-striped table-hover" style="width: 100%; table-layout: auto;">
                        <thead style="background-color: #FFBB94; color: black; text-align: center;">
                            <tr style="background-color: #A33757">
                                <th style="min-width: 50px;">No</th>
                                <th style="min-width: 150px;">Nama</th>
                                <th style="min-width: 200px;">Email</th>
                                <th style="min-width: 100px;">Peran</th>
                                <th style="min-width: 150px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semuaPengguna as $index => $pengguna)
                                <tr style="background-color: {{ $index % 2 == 0 ? '#FB9590' : '#DC586D' }}; color: white;">
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td>{{ $pengguna->name }}</td>
                                    <td>{{ $pengguna->email }}</td>
                                    <td style="text-transform: capitalize; text-align: center;">{{ $pengguna->role }}</td>
                                    <td style="text-align: center;">
                                        <button wire:click="pilihEdit({{ $pengguna->id }})" class="btn btn-sm"
                                            style="background-color: #852E4E; border: 1px solid #A33757; color: white;">
                                            ✏️ Edit
                                        </button>
                                        <button wire:click="pilihHapus({{ $pengguna->id }})" class="btn btn-sm"
                                            style="background-color: #4C1D3D; border: 1px solid red; color: white;">
                                            ❌ Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <button wire:loading class="btn btn-info" style="margin-top: 10px; background-color: #852E4E; border: none;">
                    Loading...
                </button>

            @elseif ($pilihanMenu == 'tambah' || $pilihanMenu == 'edit')
                <div class="card shadow-lg" style="width: 300%; max-width: 1200px; margin: auto; background-color: #FFFBF2;">
                    <div class="card-header" style="background-color: #DC586D; color: white;">
                        {{ $pilihanMenu == 'tambah' ? 'Tambah Pengguna' : 'Edit Pengguna' }}
                    </div>
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

                            <button type="submit" class="btn mt-3"
                                style="background-color: #A33757; color: white;">💾 Simpan</button>
                            <button type="button" wire:click='batal' class="btn mt-3"
                                style="background-color: #4C1D3D; color: white;">❌ Batal</button>
                        </form>
                    </div>
                </div>

            @elseif ($pilihanMenu == 'hapus')
                <div class="card border-danger shadow-lg" style="width: 100%; max-width: 500px; margin: auto; background-color: #FB9590;">
                    <div class="card-header" style="background-color: #852E4E; color: white;">
                        Hapus Pengguna
                    </div>
                    <div class="card-body text-center">
                        @if($penggunaTerpilih)
                            <p class="fw-bold text-danger">Anda yakin ingin menghapus pengguna ini?</p>
                            <p>Nama: <strong>{{ $penggunaTerpilih->name }}</strong></p>
                            <button class="btn" style="background-color: #4C1D3D; color: white;" wire:click="hapus">❌ HAPUS</button>
                            <button class="btn" style="background-color: #A33757; color: white;" wire:click="batal">BATAL</button>
                        @else
                            <p class="text-danger">Tidak ada pengguna yang dipilih.</p>
                        @endif
                    </div>
                </div>
            @endif
            
        </div>
    </div>
</div>
