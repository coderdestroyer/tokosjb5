<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyOnDetailProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detail_produk', function (Blueprint $table) {
            $table->dropForeign(['id_produk']);
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
            $table->foreign('id_produk')->references('id_produk')->on('produk')->onDelete('cascade');
        });
    }
}
