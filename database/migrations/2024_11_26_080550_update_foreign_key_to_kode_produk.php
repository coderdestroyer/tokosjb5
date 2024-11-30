<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyToKodeProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_produk', function (Blueprint $table) {
            $table->renameColumn('id_produk', 'kode_produk');
        });

        Schema::table('detail_produk', function (Blueprint $table) {
            $table->foreign('kode_produk')->references('kode_produk')->on('produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_produk', function (Blueprint $table) {
            $table->dropForeign(['kode_produk']);

            $table->renameColumn('kode_produk', 'id_produk');
        });

        Schema::table('detail_produk', function (Blueprint $table) {
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');
        });
    }
}
