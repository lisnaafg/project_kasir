<?php

use App\Livewire\Beranda;
use App\Livewire\User;
use App\Livewire\Laporan;
use App\Livewire\Produk;
use App\Livewire\Transaksi;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);


Route::get('/home', Beranda::class)->middleware(['auth'])->name('home');
Route::get('/user', User::class)->middleware(['auth'])->name('user');
Route::get('/laporan', Laporan::class)->middleware(['auth'])->name('laporan');
Route::get('/produk', Produk::class)->middleware(['auth'])->name('produk');
Route::get('/transaksi', Transaksi::class)->middleware(['auth'])->name('transaksi');

// Route::get('/', [HomeController::class, 'index']);
Route::get('/cetak', [HomeController::class, 'cetak']);
// Route::get('/cetak', ['App\Http\Controllers\HomeController::class', 'cetak']);
