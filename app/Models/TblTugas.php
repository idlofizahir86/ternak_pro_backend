<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Tugas",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="jenis_tugas_id", type="integer", example=1),
 *     @OA\Property(property="tgl_tugas", type="string", format="date", example="2025-08-20"),
 *     @OA\Property(property="waktu_tugas", type="string", format="date-time", example="2025-08-20T12:00:00Z"),
 *     @OA\Property(property="status_tugas_id", type="integer", example=1),
 *     @OA\Property(property="pengulangan_id", type="integer", example=1),
 *     @OA\Property(property="is_pengingat", type="boolean", example=true),
 *     @OA\Property(property="catatan", type="string", example="Catatan tugas"),
 *     @OA\Property(
 *         property="user",
 *         ref="#/components/schemas/User"
 *     ),
 *     @OA\Property(
 *         property="jenis_tugas",
 *         ref="#/components/schemas/JenisTugas"
 *     ),
 *     @OA\Property(
 *         property="status_tugas",
 *         ref="#/components/schemas/StatusTugas"
 *     ),
 *     @OA\Property(
 *         property="pengulangan",
 *         ref="#/components/schemas/PengulanganTugas"
 *     )
 * )
 */
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