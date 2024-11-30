<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateViewProdukLowStok extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE VIEW stok_low AS
            SELECT 
                p.nama_produk,
                dp.stok_produk,
                dp.merk,
                k.nama_kategori AS kategori
            FROM 
                produk p
            JOIN 
                detail_produk dp ON p.kode_produk = dp.kode_produk
            JOIN 
                kategori k ON p.id_kategori = k.id_kategori
            WHERE 
                dp.stok_produk < 10;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS stok_low');
    }
}
