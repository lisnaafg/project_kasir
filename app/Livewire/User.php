<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User as ModelUser;
use Illuminate\Support\Facades\Hash;

class User extends Component
{

    public function render()
    {
        return view('livewire.user', [
            'semuaPengguna' => ModelUser::all()
        ]);
    }
    
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

    

    public $penggunaTerpilih;
    public function pilihHapus($id){
        $this->penggunaTerpilih = ModelUser::findOrFail($id);
        $this->pilihanMenu = 'hapus';
    }

    public function hapus()
    {
        $this->penggunaTerpilih->delete();
        $this->pilihMenu('lihat');
    }

    public function batal()
    {
        $this->reset();
    }


    public function pilihEdit($id)
    {
        $this->penggunaTerpilih = ModelUser::findOrFail($id);
        $this->nama = $this->penggunaTerpilih->name;
        $this->email = $this->penggunaTerpilih->email;
        $this->peran = $this->penggunaTerpilih->role;
        $this->pilihanMenu = 'edit';
    }

    public function simpanEdit()
    {
        $this->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $this->penggunaTerpilih->id,
            'peran' => 'required',
        ],[
            'nama.required' => 'Nama harus diisi',
            'nama.required' => 'Nama harus diisi',
            'email.email' => 'email tidak valid',
            'email.unique' => 'Email sudah Terdaftar',
            'peran.required' => 'Peran harus dipilih',
        ]);

        $simpan = $this->penggunaTerpilih;
        $simpan->name = $this->nama;
        $simpan->email = $this->email;
        if ($this->password){
            $simpan->password =bcrypt($this->password);
        }

        $simpan->role = $this->peran;
        $simpan->save();

        $this->reset('nama', 'email', 'peran', 'penggunaTerpilih');
        $this->pilihMenu('lihat');
    }

    // public function mount(){
    //     if (auth()->user()->role != 'admin'){
    //         abort(403);
    //     }
    // }
    
}
