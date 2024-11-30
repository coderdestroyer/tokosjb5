<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProcedureTambahTransaksiPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedure = "
        CREATE PROCEDURE tambah_transaksi_penjualan(
            IN p_nomor_invoice INT(10),
            IN p_id_user INT,
            IN p_id_kasir INT,
            IN p_tanggal_penjualan DATETIME,
            IN p_detail_penjualan JSON
        )
        BEGIN
            -- Menyatakan variabel untuk total harga
            DECLARE total_harga DECIMAL(10, 2) DEFAULT 0;
            DECLARE subtotal DECIMAL(10, 2) DEFAULT 0;
            DECLARE i INT DEFAULT 0;
            DECLARE error_occurred INT DEFAULT 0;

            -- Memulai transaksi
            START TRANSACTION;

            -- Menambahkan data ke tabel penjualan
            INSERT INTO penjualan (nomor_invoice, id_user, id_kasir, tanggal_penjualan, created_at, updated_at)
            VALUES (p_nomor_invoice, p_id_user, p_id_kasir, p_tanggal_penjualan, NOW(), NOW());

            -- Loop untuk menghitung total harga dan menambahkan data ke penjualan_detail
            WHILE i < JSON_LENGTH(p_detail_penjualan) DO
                SET subtotal = JSON_UNQUOTE(JSON_EXTRACT(p_detail_penjualan, CONCAT('$[', i, '].harga_jual_produk'))) * 
                               JSON_UNQUOTE(JSON_EXTRACT(p_detail_penjualan, CONCAT('$[', i, '].jumlah')));
                SET total_harga = total_harga + subtotal;

                -- Menambahkan data ke tabel penjualan_detail
                INSERT INTO penjualan_detail (id_penjualan, nomor_invoice, nama_produk, harga_jual_produk, jumlah, created_at, updated_at)
                VALUES (
                    (SELECT id_penjualan FROM penjualan WHERE nomor_invoice = p_nomor_invoice),
                    p_nomor_invoice,
                    JSON_UNQUOTE(JSON_EXTRACT(p_detail_penjualan, CONCAT('$[', i, '].nama_produk'))),
                    JSON_UNQUOTE(JSON_EXTRACT(p_detail_penjualan, CONCAT('$[', i, '].harga_jual_produk'))),
                    JSON_UNQUOTE(JSON_EXTRACT(p_detail_penjualan, CONCAT('$[', i, '].jumlah'))),
                    NOW(),
                    NOW()
                );

                -- Pindah ke data berikutnya
                SET i = i + 1;
            END WHILE;

            -- Mengupdate total harga pada tabel penjualan
            UPDATE penjualan
            SET updated_at = NOW(), total_harga = total_harga
            WHERE nomor_invoice = p_nomor_invoice;

            -- Jika tidak ada error, commit transaksi
            COMMIT;

        END
        ";

        // Menjalankan prosedur menggunakan DB::unprepared
        DB::unprepared($procedure);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS tambah_transaksi_penjualan;");
    }
}
