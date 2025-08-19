<?php

namespace Database\Seeders;

use App\Models\MHewan;
use Illuminate\Database\Seeder;

class MHewanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data ras sapi
        MHewan::create([
            'nama' => 'Sapi',
            'icon_path' => 'assets/data_ternak_assets/icons/ic_cow_hd.png',
            'is_aktif' => true
        ]);

        // MHewan::create([
        //     'nama' => 'Kambing',
        //     'icon_path' => 'assets/data_ternak_assets/icons/ic_cow_hd.png',
        //     'is_aktif' => true
        // ]);
    }
}
