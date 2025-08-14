<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MStatusTugas extends Model
{
    protected $fillable = ['nama', 'is_aktif'];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];
}