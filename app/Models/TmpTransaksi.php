<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmpTransaksi extends Model
{
    use HasFactory;

    protected $table = 'tmp_transaksi';

    protected $fillable = [
        'id_user',
        'kode_produk',
        'jumlah',
    ];
}
