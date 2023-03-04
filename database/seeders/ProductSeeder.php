<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produk::insert([[
            'nama_produk' => 'PIA COKLAT',
            'harga_produk' => '100000',
            'keterangan' => 'PIA COKLAT ISI 8 PCS',
            'is_active' => true,
        ], [
            'nama_produk' => 'PIA KEJU',
            'harga_produk' => '100000',
            'keterangan' => 'PIA KEJU ISI 8 PCS',
            'is_active' => true,
        ], [
            'nama_produk' => 'PIA CAMPUR',
            'harga_produk' => '100000',
            'keterangan' => 'PIA CAMPUR ISI COKLAT 4 PCS + KEJU 4 PCS',
            'is_active' => true,
        ], [
            'nama_produk' => 'PIA KACANG HIJAU',
            'harga_produk' => '100000',
            'keterangan' => 'PIA KACANG HIJAU ISI 8 PCS',
            'is_active' => true,
        ]]);
    }
}
