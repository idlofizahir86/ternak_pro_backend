<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Keuangan",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="string", example="user123"),
 *     @OA\Property(property="is_pengeluaran", type="boolean", example=true),
 *     @OA\Property(property="tgl_keuangan", type="string", format="date", example="2025-08-20"),
 *     @OA\Property(property="nominal_total", type="number", format="float", example=1000000.00),
 *     @OA\Property(property="dari_tujuan", type="string", example="Pembelian pakan"),
 *     @OA\Property(property="aset_id", type="integer", example=1),
 *     @OA\Property(property="catatan", type="string", example="Pembelian pakan untuk sapi"),
 *     @OA\Property(
 *         property="user",
 *         ref="#/components/schemas/User"
 *     ),
 *     @OA\Property(
 *         property="asset",
 *         ref="#/components/schemas/MAsset"
 *     )
 * )
 */
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
