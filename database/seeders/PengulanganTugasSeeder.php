<?php

namespace Database\Seeders;

use App\Models\MPengulanganTugas;
use Illuminate\Database\Seeder;

class PengulanganTugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MPengulanganTugas::create([
            'nama' => 'Tidak berulang',
            'is_aktif' => true
        ]);
        MPengulanganTugas::create([
            'nama' => 'Setiap hari',
            'is_aktif' => true
        ]);
        MPengulanganTugas::create([
            'nama' => 'Setiap minggu',
            'is_aktif' => true
        ]);
        MPengulanganTugas::create([
            'nama' => 'Setiap bulan',
            'is_aktif' => true
        ]);
        MPengulanganTugas::create([
            'nama' => 'Setiap tahun',
            'is_aktif' => true
        ]);
        MPengulanganTugas::create([
            'nama' => 'Khusus..',
            'is_aktif' => true
        ]);
    }
}
