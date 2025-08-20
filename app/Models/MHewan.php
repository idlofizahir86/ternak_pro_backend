<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Hewan",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nama", type="string", example="Sapi"),
 *     @OA\Property(property="icon_path", type="string", example="/icons/sapi.png"),
 *     @OA\Property(property="is_aktif", type="boolean", example=true)
 * )
 */
class MHewan extends Model
{
    protected $fillable = ['nama', 'icon_path', 'is_aktif'];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];
}