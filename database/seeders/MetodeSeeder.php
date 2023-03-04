<?php

namespace Database\Seeders;

use App\Models\MetodePembayaran;
use Illuminate\Database\Seeder;

class MetodeSeeder extends Seeder
{
    public function run()
    {
        MetodePembayaran::insert([[
            'metode' => 'Cash',
            'keterangan' => 'Cash',
        ], [
            'metode' => 'Transfer Bank',
            'keterangan' => 'Transfer melalui Bank BCA',
        ], [
            'metode' => 'BCA CC',
            'keterangan' => 'BCA CC',
        ], [
            'metode' => 'BCA Debit',
            'keterangan' => 'BCA Debit',
        ], [
            'metode' => 'Mandiri CC',
            'keterangan' => 'Mandiri CC',
        ], [
            'metode' => 'Mandiri Debit',
            'keterangan' => 'Mandiri Debit',
        ], [
            'metode' => 'QRIS',
            'keterangan' => 'QRIS',
        ], [
            'metode' => 'Gratis / Free',
            'keterangan' => 'Diberikan secara Gratis / Free',
        ]]);
    }
}
