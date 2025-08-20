<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="TipsKategori",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nama", type="string", example="Perawatan"),
 *     @OA\Property(property="is_aktif", type="boolean", example=true)
 * )
 */
class TipsKategori extends Model
{
    protected $fillable = ['nama', 'is_aktif'];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];
}