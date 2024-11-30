<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateViewLaporanPembelianBulanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE VIEW laporan_pembelian_bulanan AS
            SELECT 
                MONTH(p.tanggal_pembelian) AS bulan,
                YEAR(p.tanggal_pembelian) AS tahun,
                SUM(pd.jumlah) AS total_produk,
                SUM(pd.harga_beli_produk * pd.jumlah) AS total_harga
            FROM 
                pembelian_detail pd
            JOIN 
                pembelian p ON pd.id_pembelian = p.id_pembelian
            GROUP BY 
                YEAR(p.tanggal_pembelian), MONTH(p.tanggal_pembelian);
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP VIEW IF EXISTS laporan_pembelian_bulanan');
    }
}
