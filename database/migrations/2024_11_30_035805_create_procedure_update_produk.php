<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProcedureUpdateProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            DROP PROCEDURE IF EXISTS update_produk;

            CREATE PROCEDURE update_produk(
                IN p_id_produk INT,
                IN p_nama_produk VARCHAR(255),
                IN p_kategori INT,
                IN p_harga_beli DECIMAL(10, 2),
                IN p_harga_jual DECIMAL(10, 2),
                IN p_merk VARCHAR(100),
                IN p_stok_produk INT
            )
            BEGIN
                DECLARE EXIT HANDLER FOR SQLEXCEPTION
                BEGIN
                    -- Rollback if any error occurs
                    ROLLBACK;
                END;

                -- Start a transaction
                START TRANSACTION;

                -- Update tabel produk
                UPDATE produk
                SET 
                    nama_produk = p_nama_produk,
                    id_kategori = p_kategori,
                    harga_jual = p_harga_jual
                WHERE 
                    id_produk = p_id_produk;

                -- Update tabel detail_produk
                UPDATE detail_produk
                SET 
                    harga_beli_produk = p_harga_beli,
                    stok_produk = p_stok_produk,
                    merk = p_merk
                WHERE 
                    id_produk = p_id_produk;

                -- Commit transaction if everything is successful
                COMMIT;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS update_produk');
    }
}
