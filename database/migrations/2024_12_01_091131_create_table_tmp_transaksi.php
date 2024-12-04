<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableTmpTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_transaksi', function (Blueprint $table) {
            $table->id('id_tmp_transaksi'); // Primary key
            $table->unsignedBigInteger('id_user'); // ID pengguna
            $table->string('kode_produk', 50); // Kode produk
            $table->integer('jumlah'); // Jumlah produk
            $table->timestamps(); // Kolom created_at dan updated_at

            // Tambahkan foreign key jika diperlukan
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmp_transaksi');
    }
}
