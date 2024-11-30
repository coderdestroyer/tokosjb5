<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UbahProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropForeign(['id_kategori']);

            $table->dropColumn(['id_kategori', 'stok', 'merk', 'diskon', 'harga_beli', 'harga_jual']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->unsignedInteger('id_kategori');
            $table->integer('stok');
            $table->string('merk')->nullable();
            $table->integer('harga_beli');
            $table->tinyInteger('diskon')->default(0);
            $table->integer('harga_jual');

            $table->foreign('id_kategori')->references('id')->on('kategori');
        });
    }
}
