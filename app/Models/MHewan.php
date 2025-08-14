<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MHewan extends Model
{
    protected $fillable = ['nama', 'icon_path', 'is_aktif'];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];
}