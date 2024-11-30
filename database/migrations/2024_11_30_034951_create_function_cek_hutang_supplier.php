<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFunctionCekHutangSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE FUNCTION cek_hutang_supplier(p_id_supplier INT)
            RETURNS DECIMAL(10, 2)
            DETERMINISTIC
            BEGIN
                DECLARE total_hutang DECIMAL(10, 2);

                SELECT SUM(pd.harga_beli_produk * pd.jumlah)
                INTO total_hutang
                FROM pembelian_detail pd
                JOIN pembelian p ON pd.id_pembelian = p.id_pembelian
                WHERE p.id_supplier = p_id_supplier AND pd.status = "belum lunas";

                RETURN IFNULL(total_hutang, 0);
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
        DB::unprepared('DROP FUNCTION IF EXISTS cek_hutang_supplier');
    }
}
