<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuplierKategori extends Model
{
    protected $fillable = ['nama', 'is_aktif'];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];
}
