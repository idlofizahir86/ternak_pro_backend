<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="JenisTugas",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="nama", type="string", example="Tugas Harian"),
 *     @OA\Property(property="icon_path", type="string", example="/icons/tugas-harian.png"),
 *     @OA\Property(
 *         property="user",
 *         ref="#/components/schemas/User"
 *     )
 * )
 */
class MJenisTugas extends Model
{
    protected $table = 'm_jenis_tugas';
    protected $fillable = ['user_id', 'nama', 'icon_path'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }
}