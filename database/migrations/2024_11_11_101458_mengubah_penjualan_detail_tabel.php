<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MengubahPenjualanDetailTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjualan_detail', function (Blueprint $table) {
            $table->dropColumn(['diskon', 'subtotal']);

            $table->renameColumn('harga_jual', 'harga_jual_produk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penjualan_detail', function (Blueprint $table) {
            $table->tinyInteger('diskon')->default(0);
            $table->integer('subtotal');

            $table->renameColumn('harga_jual_produk', 'harga_jual');
        });
    }
}
