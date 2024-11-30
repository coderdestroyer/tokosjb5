<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPenjualanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('penjualan', function (Blueprint $table) {
            $table->unsignedBigInteger('id_penjualan')->change();
        });
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropPrimary(['id_penjualan']);
        });
        Schema::table('penjualan', function (Blueprint $table) {
            $table->dropColumn('id_penjualan');
        });
        
        DB::statement("ALTER TABLE penjualan MODIFY COLUMN nomor_invoice INT AUTO_INCREMENT PRIMARY KEY FIRST");

        Schema::table('penjualan', function (Blueprint $table) {
            $table->increments('nomor_invoice')->change();
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
                    $table->dropPrimary(['nomor_invoice']);
                });
        
                Schema::table('penjualan', function (Blueprint $table) {
                    $table->bigIncrements('id_penjualan');
                });
        
                Schema::table('penjualan', function (Blueprint $table) {
                    $table->unsignedBigInteger('nomor_invoice')->change();
                });
        
    }
}
