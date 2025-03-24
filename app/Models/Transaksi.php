<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DetilTransaksi;

class Transaksi extends Model
{
    protected $fillable = ['kode', 'total', 'status'];

    public function detilTransaksi()
    {
        return $this->hasMany(DetilTransaksi::class);
    }
    protected $table = 'transaksis'; // Pastikan sesuai dengan nama tabel di databa
    public function items()
    {
        return $this->hasMany(DetilTransaksi::class, 'transaksi_id');
    }

    
}
