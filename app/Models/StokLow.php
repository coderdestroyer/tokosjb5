<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokLow extends Model
{
    protected $table = 'stok_low'; // Nama view yang ada di database

    // Tentukan primary key jika diperlukan, jika tidak ada primary key di view, Anda bisa menonaktifkannya
    protected $primaryKey = null;
    public $incrementing = false;
    
    // Tentukan field yang boleh diisi
    protected $fillable = ['nama_produk', 'stok_produk', 'merk', 'kategori'];
}
