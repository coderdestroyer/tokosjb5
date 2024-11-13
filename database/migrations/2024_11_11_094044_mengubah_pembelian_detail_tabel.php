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
            // Mengganti kolom harga_beli menjadi harga_beli_produk
            $table->renameColumn('harga_beli', 'harga_beli_produk');
            
            // Menambahkan kolom status dengan nilai default 'tidak lunas'
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
            // Menghapus kolom status jika rollback dilakukan
            $table->dropColumn('status');

            // Mengganti nama kolom harga_beli_produk kembali menjadi harga_beli
            $table->renameColumn('harga_beli_produk', 'harga_beli');
        });
    }
}
