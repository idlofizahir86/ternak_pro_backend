<?php

namespace Database\Seeders;

use App\Models\SuplierKategori;
use Illuminate\Database\Seeder;

class SuplierKategorisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SuplierKategori::create([
            'nama' => 'Semua',
            'is_aktif' => true
        ]);
        SuplierKategori::create([
            'nama' => 'Mentah',
            'is_aktif' => true
        ]);
        SuplierKategori::create([
            'nama' => 'Olahan',
            'is_aktif' => true
        ]);
    }
}
