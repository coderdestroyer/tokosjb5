<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MembuatKhususKasirTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasir', function (Blueprint $table) {
            $table->increments('id_kasir'); // Kolom id_kasir sebagai primary key
            $table->unsignedBigInteger('id_user'); // Ganti dengan unsignedBigInteger untuk kecocokan tipe data
            $table->string('nomor_hp'); // Kolom nomor_hp
            $table->text('alamat')->nullable(); // Kolom alamat (nullable)
            $table->timestamps();

            // Menambahkan foreign key constraint
            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')  // pastikan tabel users sudah ada
                  ->onDelete('cascade'); // Jika user dihapus, kasir terkait juga dihapus
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kasir');
    }
}
