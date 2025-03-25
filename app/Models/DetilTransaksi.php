<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;
use App\Models\Produk;

class DetilTransaksi extends Model
{
    use HasFactory;

    protected $table = 'detil_transaksis'; // Sesuaikan dengan nama tabel
    protected $fillable = ['transaksi_id', 'produk_id', 'jumlah', 'subtotal'];

    // Relasi ke Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}

