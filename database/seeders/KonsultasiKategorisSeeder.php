<?php

namespace Database\Seeders;

use App\Models\KonsultasiKategori;
use Illuminate\Database\Seeder;

class KonsultasiKategorisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KonsultasiKategori::create([
            'nama' => 'Semua',
            'is_aktif' => true
        ]);
        KonsultasiKategori::create([
            'nama' => 'Pakan',
            'is_aktif' => true
        ]);
        KonsultasiKategori::create([
            'nama' => 'Kesehatan',
            'is_aktif' => true
        ]);
    }
}
