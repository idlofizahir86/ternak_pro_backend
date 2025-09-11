<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="SuplierItem",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="image_url", type="array", @OA\Items(type="string", format="url", example="https://example.com/image.jpg")),
 *     @OA\Property(property="judul", type="string", example="Pakan Sapi Premium"),
 *     @OA\Property(property="detail", type="string", example="Pakan berkualitas tinggi untuk sapi perah"),
 *     @OA\Property(property="khasiat", type="string", example="Meningkatkan produksi susu"),
 *     @OA\Property(property="kategori_id", type="integer", example=1),
 *     @OA\Property(property="is_stok", type="boolean", example=true),
 *     @OA\Property(property="harga", type="number", format="float", example=100000.00),
 *     @OA\Property(property="no_tlp", type="string", example="08123456789"),
 *     @OA\Property(property="alamat_overview", type="string", example="Toko Pakan XYZ"),
 *     @OA\Property(property="alamat", type="string", example="Jl. Raya No. 123, Jakarta"),
 *     @OA\Property(property="maps_link", type="string", format="url", example="https://maps.google.com/?q=loc:123,456"),
 *     @OA\Property(
 *         property="kategori",
 *         ref="#/components/schemas/SuplierKategori"
 *     )
 * )
 */
class SuplierItem extends Model
{
    protected $fillable = [
        'image_url',
        'judul',
        'detail',
        'khasiat',
        'kategori_id',
        'is_stok',
        'harga',
        'no_tlp',
        'alamat_overview',
        'alamat',
        'maps_link',
    ];

    protected $casts = [
        'is_stok' => 'boolean',
    ];

    public function kategori()
    {
        return $this->belongsTo(SuplierKategori::class, 'kategori_id');
    }
}
