<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblPengulanganTugas extends Model
{
    protected $fillable = [
        'user_id',
        'pengulangan_tugas_id',
        'n_pengulangan',
        'satuan_pengulangan',
        'hari_pengulangan',
        'n_kerekapan',
        'total_kerekapan',
        'tgl_akhir',
    ];

    protected $casts = [
        'hari_pengulangan' => 'array',
        'tgl_akhir' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }

    public function pengulanganTugas()
    {
        return $this->belongsTo(MPengulanganTugas::class, 'pengulangan_tugas_id');
    }
}