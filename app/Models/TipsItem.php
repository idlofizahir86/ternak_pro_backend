<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="TipsItem",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="image_url", type="string", format="url", example="https://example.com/image.jpg"),
 *     @OA\Property(property="judul", type="string", example="Tips Merawat Sapi"),
 *     @OA\Property(property="konten", type="string", example="Pastikan sapi mendapatkan pakan yang cukup..."),
 *     @OA\Property(property="kategori", type="array", @OA\Items(type="string", example="Perawatan")),
 *     @OA\Property(property="kategori_detail", type="string", example="Detail kategori")
 * )
 */
class TipsItem extends Model
{
    protected $fillable = ['image_url', 'judul', 'konten', 'kategori', 'kategori_detail'];

    protected $casts = [
        'kategori' => 'array',
    ];
}