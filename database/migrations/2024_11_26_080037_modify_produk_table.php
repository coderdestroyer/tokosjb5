<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->unsignedBigInteger('id_produk')->change(); 
        });
        Schema::table('produk', function (Blueprint $table) {
            $table->dropPrimary(['id_produk']);
        });
        Schema::table('produk', function (Blueprint $table) {
            $table->dropColumn('id_produk');
        });

        Schema::table('produk', function (Blueprint $table) {
            $table->unsignedBigInteger('kode_produk')->change();
            $table->primary('kode_produk');
        });
        Schema::table('produk', function (Blueprint $table) {
            $table->increments('kode_produk')->change();
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
            $table->dropPrimary(['kode_produk']);
        });

        Schema::table('produk', function (Blueprint $table) {
            $table->bigIncrements('id_produk');
        });

        Schema::table('produk', function (Blueprint $table) {
            $table->unsignedBigInteger('kode_produk')->change();
        });
    }
}
