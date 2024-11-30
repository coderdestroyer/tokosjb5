<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailProdukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Mengambil id_produk berdasarkan kode_produk atau nama_produk
        $produkA = DB::table('produk')->where('kode_produk', '1')->first();
        $produkB = DB::table('produk')->where('kode_produk', '2')->first();

        // Memasukkan data ke dalam tabel detail_produk dengan mengambil id_produk dari produk
        DB::table('detail_produk')->insert([
            [
                'kode_produk' => $produkA->kode_produk, // ID produk A
                'stok_produk' => 100,
                'merk' => 'Merk A',
                'harga_beli_produk' => 40000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_produk' => $produkB->kode_produk, // ID produk B
                'stok_produk' => 50,
                'merk' => 'Merk B',
                'harga_beli_produk' => 60000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lain sesuai kebutuhan
        ]);
    }
}
