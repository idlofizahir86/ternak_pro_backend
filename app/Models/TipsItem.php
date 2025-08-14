<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipsItem extends Model
{
    protected $fillable = ['image_url', 'judul', 'konten', 'kategori', 'kategori_detail'];

    protected $casts = [
        'kategori' => 'array',
    ];
}