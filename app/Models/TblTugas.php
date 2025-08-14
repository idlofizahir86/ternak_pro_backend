<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblTugas extends Model
{
    protected $fillable = [
        'user_id',
        'jenis_tugas_id',
        'tgl_tugas',
        'waktu_tugas',
        'status_tugas_id',
        'pengulangan_id',
        'is_pengingat',
        'catatan',
    ];

    protected $casts = [
        'is_pengingat' => 'boolean',
        'tgl_tugas' => 'date',
        'waktu_tugas' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }

    public function jenisTugas()
    {
        return $this->belongsTo(MJenisTugas::class, 'jenis_tugas_id');
    }

    public function statusTugas()
    {
        return $this->belongsTo(MStatusTugas::class, 'status_tugas_id');
    }

    public function pengulangan()
    {
        return $this->belongsTo(MPengulanganTugas::class, 'pengulangan_id');
    }
}