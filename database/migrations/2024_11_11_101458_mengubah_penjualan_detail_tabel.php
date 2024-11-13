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
            // Menghapus kolom yang tidak dibutuhkan
            $table->dropColumn(['diskon', 'subtotal']);

            // Mengubah kolom harga_jual menjadi harga_jual_produk
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
            // Menambahkan kembali kolom yang dihapus
            $table->tinyInteger('diskon')->default(0);
            $table->integer('subtotal');

            // Mengubah kembali nama kolom harga_jual_produk ke harga_jual
            $table->renameColumn('harga_jual_produk', 'harga_jual');
        });
    }
}
