<?php

namespace Database\Seeders;

use App\Models\TipsKategori;
use Illuminate\Database\Seeder;

class TipsKategorisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipsKategori::create([
            'nama' => 'Semua',
            'is_aktif' => true
        ]);
        TipsKategori::create([
            'nama' => 'Kesehatan',
            'is_aktif' => true
        ]);
        TipsKategori::create([
            'nama' => 'Perawatan',
            'is_aktif' => true
        ]);
        TipsKategori::create([
            'nama' => 'Bisnis',
            'is_aktif' => true
        ]);
    }
}
