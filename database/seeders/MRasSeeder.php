<?php

namespace Database\Seeders;

use App\Models\MRas;
use Illuminate\Database\Seeder;

class MRasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Menambahkan data ras sapi
        MRas::create([
            'nama' => 'Sapi Bali',
            'is_aktif' => true
        ]);

        MRas::create([
            'nama' => 'Sapi Madura',
            'is_aktif' => true
        ]);

        MRas::create([
            'nama' => 'Sapi PO (Peranakan Ongole)',
            'is_aktif' => true
        ]);

        MRas::create([
            'nama' => 'Sapi Simmental',
            'is_aktif' => true
        ]);

        MRas::create([
            'nama' => 'Sapi Brahman',
            'is_aktif' => true
        ]);

        // Menambahkan data ras kambing
        // MRas::create([
        //     'nama' => 'Kambing Kacang',
        //     'is_aktif' => true
        // ]);

        // MRas::create([
        //     'nama' => 'Kambing Peranakan Etawa (PE)',
        //     'is_aktif' => true
        // ]);

        // MRas::create([
        //     'nama' => 'Kambing Boer',
        //     'is_aktif' => true
        // ]);

        // MRas::create([
        //     'nama' => 'Kambing Etawa',
        //     'is_aktif' => true
        // ]);

        // MRas::create([
        //     'nama' => 'Lainnya',
        //     'is_aktif' => true
        // ]);
    }
}
