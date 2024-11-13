<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UbahProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            // Hapus foreign key constraint pada kolom id_kategori
            $table->dropForeign(['id_kategori']);

            // Hapus kolom yang tidak diperlukan
            $table->dropColumn(['id_kategori', 'stok', 'merk', 'diskon', 'harga_beli', 'harga_jual']);
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
            // Tambahkan kembali kolom yang dihapus jika rollback
            $table->unsignedInteger('id_kategori');
            $table->integer('stok');
            $table->string('merk')->nullable();
            $table->integer('harga_beli');
            $table->tinyInteger('diskon')->default(0);
            $table->integer('harga_jual');

            // Tambahkan kembali foreign key jika rollback
            $table->foreign('id_kategori')->references('id')->on('kategori');
        });
    }
}
