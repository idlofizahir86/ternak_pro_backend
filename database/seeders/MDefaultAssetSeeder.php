<?php

namespace Database\Seeders;

use App\Models\MDefaultAsset;
use Illuminate\Database\Seeder;

class MDefaultAssetSeeder extends Seeder
{
    public function run()
    {
        MDefaultAsset::create([
            'nama' => 'Tunai',
            'is_aktif' => true
        ]);

        MDefaultAsset::create([
            'nama' => 'Rekening',
            'is_aktif' => true
        ]);
    }
}
