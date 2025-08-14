<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipsKategori extends Model
{
    protected $fillable = ['nama', 'is_aktif'];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];
}