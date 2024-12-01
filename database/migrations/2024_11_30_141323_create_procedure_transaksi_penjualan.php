<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateProcedureTransaksiPenjualan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            CREATE PROCEDURE proses_transaksi (
                IN p_id_user INT,
                IN p_id_kasir INT,
                IN p_tanggal_penjualan DATE,
                IN p_uang_diterima DECIMAL(10, 2)
            )
            BEGIN
                DECLARE total DECIMAL(10, 2) DEFAULT 0;
                DECLARE kembalian DECIMAL(10, 2) DEFAULT 0;
                DECLARE nomor_invoice VARCHAR(50);
                DECLARE done INT DEFAULT FALSE;
                DECLARE kode_produk VARCHAR(50);
                DECLARE jumlah INT;
                DECLARE harga DECIMAL(10, 2);
                DECLARE nama_produk VARCHAR(100);

                -- Cursor untuk mengambil data kode produk dan jumlah
                DECLARE produk_cursor CURSOR FOR
                    SELECT kode_produk, jumlah
                    FROM tmp_transaksi; -- tabel sementara untuk menyimpan produk yang akan dibeli
                DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

                -- Menghasilkan nomor invoice baru
                SET nomor_invoice = CONCAT('INV-', DATE_FORMAT(NOW(), '%Y%m%d%H%i%s'));

                -- Mulai transaksi
                START TRANSACTION;

                -- Menyimpan data transaksi utama ke tabel penjualan
                INSERT INTO penjualan (nomor_invoice, id_user, id_kasir, tanggal_penjualan, created_at, updated_at)
                VALUES (nomor_invoice, p_id_user, p_id_kasir, p_tanggal_penjualan, NOW(), NOW());

                -- Membuka cursor untuk membaca produk yang dibeli
                OPEN produk_cursor;

                -- Membaca data produk yang akan dibeli
                read_loop: LOOP
                    FETCH produk_cursor INTO kode_produk, jumlah;
                    
                    IF done THEN
                        LEAVE read_loop;
                    END IF;

                    -- Mendapatkan harga produk berdasarkan kode_produk
                    SELECT nama_produk, harga_jual INTO nama_produk, harga
                    FROM produk
                    WHERE kode_produk = kode_produk;
                    
                    -- Menghitung total untuk produk ini
                    SET total = total + (harga * jumlah);
                    
                    -- Menyimpan detail transaksi ke tabel penjualan_detail
                    INSERT INTO penjualan_detail (nomor_invoice, nama_produk, jumlah, created_at, updated_at)
                    VALUES (nomor_invoice, nama_produk, jumlah, NOW(), NOW());
                END LOOP;

                -- Menutup cursor
                CLOSE produk_cursor;

                -- Menghitung kembalian
                SET kembalian = p_uang_diterima - total;

                -- Menyimpan data transaksi total dan kembalian di tabel penjualan
                UPDATE penjualan
                SET total = total, bayar = p_uang_diterima, kembalian = kembalian, updated_at = NOW()
                WHERE nomor_invoice = nomor_invoice;

                -- Commit transaksi
                COMMIT;
                
            END
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP PROCEDURE IF EXISTS proses_transaksi");
    }
}
