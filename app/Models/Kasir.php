<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;
    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel
    protected $table = 'kasir'; 

    // Tentukan primary key jika tidak menggunakan 'id' sebagai default
    protected $primaryKey = 'id_kasir';

    // Tentukan kolom yang dapat diisi secara massal
    protected $fillable = [
        'id_user', // misalnya, jika ada kolom user_id di kasir
        'nomor_hp',
        'alamat',
        // kolom lain yang diperlukan
    ];

    protected $guarded = [
        // contoh: 'id_kasir' jika tidak ingin kolom ini bisa diubah
    ];

    // Tentukan format waktu jika kolom timestamps ada
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
