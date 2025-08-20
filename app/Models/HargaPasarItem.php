<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="HargaPasarItem",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="image_url", type="string", format="url", example="https://example.com/image.jpg"),
 *     @OA\Property(property="nama", type="string", example="Sapi Holstein"),
 *     @OA\Property(property="harga_kg", type="number", format="float", example=50000.00),
 *     @OA\Property(property="kondisi", type="string", example="Sehat"),
 *     @OA\Property(property="lokasi", type="string", example="Jakarta")
 * )
 */
class HargaPasarItem extends Model
{
    protected $fillable = ['image_url', 'nama', 'harga_kg', 'kondisi', 'lokasi'];

    protected $casts = [
        'kondisi' => 'string',
    ];
}
