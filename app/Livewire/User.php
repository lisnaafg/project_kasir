<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User as ModelUser;
use Illuminate\Support\Facades\Hash;

class User extends Component
{
    public $pilihanMenu = 'lihat';
    public $nama, $email, $password, $peran;

    public function pilihMenu($menu)
    {
        $this->pilihanMenu = $menu;
    }

    public function simpan()
    {
        $this->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'peran' => 'required',
        ], [
            'nama.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'peran.required' => 'Peran harus dipilih.',
        ]);

        $simpan = new ModelUser();
        $simpan->name = $this->nama; // Perbaikan dari $this->name ke $this->nama
        $simpan->email = $this->email;
        $simpan->password = Hash::make($this->password); // Menggunakan Hash::make untuk keamanan
        $simpan->role = $this->peran;
        $simpan->save();

        $this->reset(['nama', 'email', 'password', 'peran']);
        $this->pilihMenu('lihat'); // Kembali ke daftar pengguna setelah simpan
    }

    public function render()
    {
        return view('livewire.user', [
            'semuaPengguna' => ModelUser::all()
        ]);
    }

    public $penggunaTerpilih;

    public function pilihHapus($id){
        $this->penggunaTerpilih = ModelUser::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }

    public function hapus(){
        $this->penggunaTerpilih->delete();
        $this->pilihMenu('lihat');
    }

    public function batal(){
        $this->reset();
    }
    
}
