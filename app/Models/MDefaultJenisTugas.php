<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MDefaultJenisTugas extends Model
{
    use HasFactory;

    protected $table = 'm_default_jenis_tugas';

    protected $fillable = [
        'nama', 
        'is_aktif', 
        'icon_path'
    ];
}
