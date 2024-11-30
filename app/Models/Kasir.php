<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;
    protected $table = 'kasir'; 

    protected $primaryKey = 'id_kasir';

    protected $fillable = [
        'id_user', 
        'nomor_hp',
        'alamat',
    ];

    protected $guarded = [
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
