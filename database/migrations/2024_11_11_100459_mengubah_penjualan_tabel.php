<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MengubahPenjualanTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjualan', function (Blueprint $table) {
            // Menghapus kolom yang tidak diperlukan
            $table->dropColumn(['id_member', 'total_item', 'total_harga', 'diskon', 'bayar', 'diterima']);

            // Menambahkan kolom baru sesuai dengan permintaan
            $table->string('nomor_invoice')->unique();
            $table->integer('id_kasir')->unsigned();  // Asumsi id_kasir merujuk ke tabel 'kasir'
            $table->date('tanggal_penjualan');  // Menyimpan tanggal penjualan
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->integer('id_member');
            $table->integer('total_item');
            $table->integer('total_harga');
            $table->tinyInteger('diskon')->default(0);
            $table->integer('bayar')->default(0);
            $table->integer('diterima')->default(0);

            $table->dropColumn(['nomor_invoice', 'id_kasir', 'tanggal_penjualan']);
        });
    }
}
