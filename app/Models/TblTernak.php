<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Ternak",
 *     type="object",
 *     @OA\Property(property="id", type="string", example=1),
 *     @OA\Property(property="tag_id", type="string", example="TAG123"),
 *     @OA\Property(property="user_id", type="string", example="user123"),
 *     @OA\Property(property="nama_ternak", type="string", example="Sapi Perah"),
 *     @OA\Property(property="tgl_mulai", type="string", format="date", example="2025-08-20"),
 *     @OA\Property(property="hewan_id", type="integer", example=1),
 *     @OA\Property(property="ras_id", type="integer", example=1),
 *     @OA\Property(property="tujuan_ternak_id", type="integer", example=1),
 *     @OA\Property(property="usia", type="integer", example=24),
 *     @OA\Property(property="kondisi_ternak", type="string", example="Sehat"),
 *     @OA\Property(property="jenis_kelamin", type="string", example="Betina"),
 *     @OA\Property(property="berat", type="number", format="float", example=500.5),
 *     @OA\Property(property="catatan", type="string", example="Catatan tambahan"),
 *     @OA\Property(
 *         property="user",
 *         ref="#/components/schemas/User"
 *     ),
 *     @OA\Property(
 *         property="hewan",
 *         ref="#/components/schemas/Hewan"
 *     ),
 *     @OA\Property(
 *         property="ras",
 *         ref="#/components/schemas/Ras"
 *     ),
 *     @OA\Property(
 *         property="tujuan_ternak",
 *         ref="#/components/schemas/TujuanTernak"
 *     )
 * )
 */
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