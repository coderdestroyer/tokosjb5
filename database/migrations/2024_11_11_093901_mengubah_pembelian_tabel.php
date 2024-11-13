<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MengubahPembelianTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pembelian', function (Blueprint $table) {
            // Menambah kolom tanggal_pembelian
            $table->date('tanggal_pembelian')->after('id_pembelian');

            // Menghapus kolom yang tidak diperlukan
            $table->dropColumn([
                'total_item',
                'total_harga',
                'diskon',
                'bayar',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pembelian', function (Blueprint $table) {
            // Menambahkan kolom yang dihapus jika rollback dilakukan
            $table->integer('total_item');
            $table->integer('total_harga');
            $table->tinyInteger('diskon')->default(0);
            $table->integer('bayar')->default(0);

            // Menghapus kolom tanggal_pembelian
            $table->dropColumn('tanggal_pembelian');
        });
    }
}
