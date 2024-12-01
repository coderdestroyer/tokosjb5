<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFunctionProdukTerlaris extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE FUNCTION produk_terlaris(p_bulan INT, p_tahun INT)
            RETURNS VARCHAR(255)
            DETERMINISTIC
            BEGIN
                DECLARE nama_produk_terlaris VARCHAR(255);

                SELECT p.nama_produk
                INTO nama_produk_terlaris
                FROM produk p
                JOIN pembelian_detail pd ON pd.kode_produk = p.kode_produk
                JOIN pembelian b ON b.id_pembelian = pd.id_pembelian
                WHERE MONTH(b.tanggal_pembelian) = p_bulan 
                  AND YEAR(b.tanggal_pembelian) = p_tahun
                GROUP BY p.kode_produk
                ORDER BY SUM(pd.jumlah) DESC
                LIMIT 1;

                RETURN IFNULL(nama_produk_terlaris, "Tidak ada data");
            END
        ');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS produk_terlaris');

    }
}
