<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFunctionTotalHargaPerSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
       CREATE FUNCTION total_harga_per_supplier(p_id_supplier INT)
            RETURNS DECIMAL(10, 2)
            DETERMINISTIC
            BEGIN
                DECLARE total_harga DECIMAL(10, 2);

                SELECT SUM(pd.harga_beli_produk * pd.jumlah)
                INTO total_harga
                FROM pembelian_detail pd
                JOIN pembelian p ON p.id_pembelian = pd.id_pembelian
                WHERE p.id_supplier = p_id_supplier;

                RETURN IFNULL(total_harga, 0);
            END;
    ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP FUNCTION IF EXISTS total_harga_per_supplier');
    }
}
