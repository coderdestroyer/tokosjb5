<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateFungsiHitungSubtotalPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE FUNCTION hitung_subtotal(invoice_id INT)
            RETURNS DECIMAL(15, 2)
            DETERMINISTIC
            BEGIN
                DECLARE total DECIMAL(15, 2);
                SELECT SUM(jumlah * harga_jual_produk) INTO total
                FROM penjualan_detail
                WHERE nomor_invoice = invoice_id;
                RETURN total;
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
        DB::unprepared('DROP FUNCTION IF EXISTS calculate_total');
    }
}
