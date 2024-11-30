<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyOnPenjualanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjualan_detail', function (Blueprint $table) {
            $table->renameColumn('id_penjualan', 'nomor_invoice');
        });

        Schema::table('penjualan_detail', function (Blueprint $table) {
            $table->unsignedInteger('nomor_invoice')->change();
            $table->foreign('nomor_invoice')->references('nomor_invoice')->on('penjualan')->onDelete('cascade');
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
            $table->dropForeign(['nomor_invoice']);
            $table->renameColumn('nomor_invoice', 'id_penjualan');
        });

        Schema::table('penjualan_detail', function (Blueprint $table) {
            $table->foreign('id_penjualan')->references('id_penjualan')->on('penjualan')->onDelete('cascade');
        });

    }
}
