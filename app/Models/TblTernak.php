<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblTernak extends Model
{
    protected $fillable = [
        'tag_id',
        'user_id',
        'nama_ternak',
        'tgl_mulai',
        'hewan_id',
        'ras_id',
        'tujuan_ternak_id',
        'usia',
        'kondisi_ternak',
        'jenis_kelamin',
        'berat',
        'catatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }

    public function hewan()
    {
        return $this->belongsTo(MHewan::class, 'hewan_id');
    }

    public function ras()
    {
        return $this->belongsTo(MRas::class, 'ras_id');
    }

    public function tujuanTernak()
    {
        return $this->belongsTo(MTujuanTernak::class, 'tujuan_ternak_id');
    }
}