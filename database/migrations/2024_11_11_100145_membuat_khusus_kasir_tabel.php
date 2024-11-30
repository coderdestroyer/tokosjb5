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
            $table->increments('id_kasir'); 
            $table->unsignedBigInteger('id_user'); 
            $table->string('nomor_hp'); 
            $table->text('alamat')->nullable(); 
            $table->timestamps();

            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')  
                  ->onDelete('cascade');
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
