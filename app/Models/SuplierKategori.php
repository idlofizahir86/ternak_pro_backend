<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="SuplierKategori",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nama", type="string", example="Pakan Sapi"),
 *     @OA\Property(property="is_aktif", type="boolean", example=true)
 * )
 */
class SuplierKategori extends Model
{
    protected $fillable = ['nama', 'is_aktif'];

    protected $casts = [
        'is_aktif' => 'boolean',
    ];
}
