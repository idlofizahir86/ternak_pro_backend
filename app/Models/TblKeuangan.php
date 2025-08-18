<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TblKeuangan extends Model
{
    protected $fillable = [
        'user_id',
        'is_pengeluaran',
        'tgl_keuangan',
        'nominal_total',
        'dari_tujuan',
        'aset_id',
        'catatan',
    ];

    protected $casts = [
        'is_pengeluaran' => 'boolean',
        'tgl_keuangan' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }

    public function asset()
    {
        return $this->belongsTo(MAsset::class, 'aset_id');
    }
}
