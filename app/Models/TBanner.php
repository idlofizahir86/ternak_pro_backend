<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TBanner extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 't_banners';

    // Kolom yang bisa diisi
    protected $fillable = [
        'title',
        'bannerUrl',
        'is_aktif',  // Tambahkan is_aktif ke dalam $fillable
    ];

    // Menyembunyikan kolom yang tidak ingin ditampilkan dalam JSON response
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // Jika Anda ingin menambahkan akses timestamp di field created_at
    public $timestamps = true;
}
