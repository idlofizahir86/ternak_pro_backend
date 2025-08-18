<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KonsultasiItem extends Model
{
    protected $fillable = [
        'image_url',
        'nama',
        'kategori_id',
        'harga',
        'durasi',
        'no_tlp',
        'spesialis',
        'lokasi_praktik',
        'pukul_mulai',
        'pukul_akhir',
        'pendidikan',
        'pengalaman',
        'fokus_konsultasi',
    ];

    protected $casts = [
        'pukul_mulai' => 'datetime:H:i:s',
        'pukul_akhir' => 'datetime:H:i:s',
        'pendidikan' => 'array',
    ];

    public function kategori()
    {
        return $this->belongsTo(KonsultasiKategori::class, 'kategori_id');
    }
}
