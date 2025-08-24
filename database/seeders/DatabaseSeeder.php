<?php

namespace Database\Seeders;

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
            MHewanSeeder::class,
            MRasSeeder::class,
            StatusTugasSeeder::class,
            PengulanganTugasSeeder::class,
            TipsItemSeeder::class,
            // Tambahkan seeder lain seperti StatusTugasSeeder jika ada
        ]);
    }
}
