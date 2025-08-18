<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MDefaultTujuanTernak extends Model
{
    use HasFactory;

    protected $table = 'm_default_tujuan_ternak';

    protected $fillable = [
        'nama', 
        'is_aktif', 
        'icon_path'
    ];
}