<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProcedureTambahTransaksiPembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE PROCEDURE tambah_transaksi_pembelian(
                IN p_id_supplier INT,
                IN p_tanggal DATE,
                IN p_detail JSON
            )
            BEGIN
                DECLARE new_id_pembelian INT;
                DECLARE idx INT DEFAULT 0;
                DECLARE total_details INT;

                DECLARE EXIT HANDLER FOR SQLEXCEPTION
                BEGIN
                    -- Rollback if any error occurs
                    ROLLBACK;
                END;

                -- Start a transaction
                START TRANSACTION;

                -- Tambahkan data ke tabel pembelian
                INSERT INTO pembelian (id_supplier, tanggal_pembelian)
                VALUES (p_id_supplier, p_tanggal);

                SET new_id_pembelian = LAST_INSERT_ID();

                -- Menghitung jumlah elemen dalam JSON detail
                SET total_details = JSON_LENGTH(p_detail);

                -- Loop untuk memasukkan data detail pembelian dari JSON
                WHILE idx < total_details DO
                    INSERT INTO pembelian_detail (id_pembelian, id_produk, harga_beli_produk, jumlah)
                    VALUES (
                        new_id_pembelian,
                        JSON_UNQUOTE(JSON_EXTRACT(p_detail, CONCAT("$[", idx, "].id_produk"))),
                        JSON_UNQUOTE(JSON_EXTRACT(p_detail, CONCAT("$[", idx, "].harga_beli_produk"))),
                        JSON_UNQUOTE(JSON_EXTRACT(p_detail, CONCAT("$[", idx, "].jumlah")))
                    );
                    SET idx = idx + 1;
                END WHILE;

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
        DB::unprepared('DROP PROCEDURE IF EXISTS tambah_transaksi_pembelian');
    }
}
