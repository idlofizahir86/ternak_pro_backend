<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HargaPasarItem extends Model
{
    protected $fillable = ['image_url', 'nama', 'harga_kg', 'kondisi', 'lokasi'];

    protected $casts = [
        'kondisi' => 'string',
    ];
}
