<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produks'; // Pastikan nama tabel sesuai dengan database
    protected $fillable = ['nama', 'kode', 'harga', 'stok'];
}
