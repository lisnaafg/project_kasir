<div>
    <div class= "container">
        <div class="row my-2">
            <div class="col-12">
                <button wire:click="pilihMenu('lihat')"
                class="btn {{ $pilihanMenu == 'lihat' ? 'btn-primary' : 'btn-outline-primary' }}">Semua Pengguna</button>


                <button wire:click="pilihMenu('tambah')"
                class="btn {{ $pilihanMenu == 'tambah' ? 'btn-primary' : 'btn-outline-primary' }}">Tambah Pengguna</button>

                

        <div class="row my-2">
            <div class ="col-12">
                @if($pilihanMenu == 'lihat')
                <table class = "table table-bordered">
                    <thead></thead>
                    <thead>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Peran</th>
                        <th>Date</th>
                    </thead>
                    <tbody>
                        @foreach ($semuaPengguna as $pengguna)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $pengguna->name }}</td>
                                <td>{{ $pengguna->email }}</td>
                                <td>{{ $pengguna->role }}</td>
                                <td>
                                    <button wire:click="pilihEdit({{ $pengguna->id }})" 
                                        class="btn btn-outline-primary">Edit Pengguna</button>
                                        
                    
                                    <button wire:click="pilihHapus({{ $pengguna->id }})"
                                    class="btn {{ $pilihanMenu == 'hapus' ? 'btn-primary' : 'btn-outline-primary' }}">Hapus Pengguna</button>
                                    
                                                                       
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>

                <button wire:loading class="btn btn-info">
                    Loading........
                </button>
            </div>
        </div>
        
                @elseif ($pilihanMenu == 'tambah')
                    <form wire:submit="simpan" action="" method="post">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" wire:model="nama">
                        @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                    
                        <label for="">Email</label>
                        <input type="email" class="form-control" wire:model="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                    
                        <label for="">Password</label>
                        <input type="password" class="form-control" wire:model="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                    
                        <label for="">Peran</label>
                        <select class="form-control" wire:model="peran">
                            <option>-pilih peran--</option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                        </select>
                        @error('peran')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                    
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </form>
                
                @elseif ($pilihanMenu == 'edit')
                    <form wire:submit="simpanEdit" action="" method="post">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" wire:model="nama">
                        @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                    
                        <label for="">Email</label>
                        <input type="email" class="form-control" wire:model="email">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                    
                        <label for="">Password</label>
                        <input type="password" class="form-control" wire:model="password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                    
                        <label for="">Peran</label>
                        <select class="form-control" wire:model="peran">
                            <option>-pilih peran--</option>
                            <option value="admin">Admin</option>
                            <option value="kasir">Kasir</option>
                        </select>
                        @error('peran')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <br>
                    
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        <button type="button" wire:click='batal' class="btn btn-secondary mt-3">Batal</button>

                    </form>
                
                @elseif ($pilihanMenu == 'hapus')
                <div class="card border-primary">
                    <div class="card-header bg-danger text-white">
                        Hapus Pengguna
                    </div>
                    <div class="card-body">
                        @if($penggunaTerpilih)
                            <p>Anda yakin ingin menghapus pengguna ini?</p>
                            <p>Nama: {{ $penggunaTerpilih->name }}</p>
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
