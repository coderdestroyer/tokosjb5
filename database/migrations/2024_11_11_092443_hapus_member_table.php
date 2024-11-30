<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HapusMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('member');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('member', function (Blueprint $table) {
            $table->increments('id_member');
            $table->string('kode_member')->unique();
            $table->string('nama');
            $table->text('alamat')->nullable();
            $table->string('telepon');
            $table->timestamps();
        });
    }
}
