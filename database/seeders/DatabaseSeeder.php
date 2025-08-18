<?php

namespace Database\Seeders;

use App\Models\MDefaultAsset;
use App\Models\MDefaultJenisTugas;
use App\Models\MDefaultTujuanTernak;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            MDefaultAssetSeeder::class,
            MDefaultJenisTugasSeeder::class,
            MDefaultTujuanTernakSeeder::class,
            KonsultasiKategorisSeeder::class,
            SuplierKategorisSeeder::class,
            TipsKategorisSeeder::class,
            // Tambahkan seeder lain seperti StatusTugasSeeder jika ada
        ]);
    }
}
