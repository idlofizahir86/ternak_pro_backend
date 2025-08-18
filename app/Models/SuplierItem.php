<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuplierItem extends Model
{
    protected $fillable = [
        'image_url',
        'judul',
        'detail',
        'khasiat',
        'kategori_id',
        'is_stok',
        'harga',
        'no_tlp',
        'alamat_overview',
        'alamat',
        'maps_link',
    ];

    protected $casts = [
        'image_url' => 'array',
        'is_stok' => 'boolean',
    ];

    public function kategori()
    {
        return $this->belongsTo(SuplierKategori::class, 'kategori_id');
    }
}
