<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('produk')->insert([
            [
                'nama_produk' => 'Produk A',
                'harga_jual' => 50000,
                'id_kategori' => 1, // Sesuaikan dengan ID kategori yang ada
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Produk B',
                'harga_jual' => 75000,
                'id_kategori' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lain sesuai kebutuhan
        ]);
    }
}
