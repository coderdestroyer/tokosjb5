<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MengubahPembelianDetailTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pembelian_detail', function (Blueprint $table) {
            $table->renameColumn('harga_beli', 'harga_beli_produk');
            
            $table->enum('status', ['lunas', 'belum lunas'])->default('belum lunas')->after('jumlah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembelian_detail', function (Blueprint $table) {
            $table->dropColumn('status');

            $table->renameColumn('harga_beli_produk', 'harga_beli');
        });
    }
}
