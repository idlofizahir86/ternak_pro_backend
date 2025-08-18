<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MDefaultAsset extends Model
{
    use HasFactory;

    protected $table = 'm_default_asset';

    protected $fillable = [
        'nama', 
        'is_aktif', 
        'icon_path'
    ];
}