<?php

namespace Database\Seeders;

use App\Models\MStatusTugas;
use Illuminate\Database\Seeder;

class StatusTugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MStatusTugas::create([
            'nama' => 'Belum',
            'is_aktif' => true
        ]);
        MStatusTugas::create([
            'nama' => 'Tertentu',
            'is_aktif' => true
        ]);
        MStatusTugas::create([
            'nama' => 'Sudah',
            'is_aktif' => true
        ]);
    }
}
