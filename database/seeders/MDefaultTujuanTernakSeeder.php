<?php

namespace Database\Seeders;

use App\Models\MDefaultTujuanTernak;
use Illuminate\Database\Seeder;

class MDefaultTujuanTernakSeeder extends Seeder
{
    public function run()
    {
        MDefaultTujuanTernak::create([
            'nama' => 'Sapi Perah',
            'is_aktif' => true
        ]);

        MDefaultTujuanTernak::create([
            'nama' => 'Dijual Kembali',
            'is_aktif' => true
        ]);

        MDefaultTujuanTernak::create([
            'nama' => 'Kurban',
            'is_aktif' => true
        ]);
    }
}
