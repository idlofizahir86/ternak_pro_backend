<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MDefaultJenisTugas;

class MDefaultJenisTugasSeeder extends Seeder
{
    public function run()
    {
        MDefaultJenisTugas::create([
            'nama' => 'Pemberian Pakan & Air',
            'icon_path' => 'assets/home_assets/icons/ic_snack.png',
            'is_aktif' => true
        ]);

        MDefaultJenisTugas::create([
            'nama' => 'Vaksin Ternak',
            'icon_path' => 'assets/home_assets/icons/ic_shield.png',
            'is_aktif' => true
        ]);
    }
}
