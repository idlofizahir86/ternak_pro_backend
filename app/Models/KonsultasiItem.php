<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="KonsultasiItem",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="image_url", type="string", format="url", example="https://example.com/image.jpg"),
 *     @OA\Property(property="nama", type="string", example="Dr. John Doe"),
 *     @OA\Property(property="kategori_id", type="integer", example=1),
 *     @OA\Property(property="harga", type="number", format="float", example=500000.00),
 *     @OA\Property(property="durasi", type="string", example="1 jam"),
 *     @OA\Property(property="no_tlp", type="string", example="08123456789"),
 *     @OA\Property(property="spesialis", type="string", example="Dokter Hewan"),
 *     @OA\Property(property="lokasi_praktik", type="string", example="Jakarta"),
 *     @OA\Property(property="pukul_mulai", type="string", format="time", example="08:00:00"),
 *     @OA\Property(property="pukul_akhir", type="string", format="time", example="17:00:00"),
 *     @OA\Property(property="pendidikan", type="array", @OA\Items(type="string", example="S1 Kedokteran Hewan")),
 *     @OA\Property(property="pengalaman", type="string", example="5 tahun di klinik hewan"),
 *     @OA\Property(property="fokus_konsultasi", type="string", example="Kesehatan sapi perah"),
 *     @OA\Property(
 *         property="kategori",
 *         ref="#/components/schemas/KonsultasiKategori"
 *     )
 * )
 */
class KonsultasiItem extends Model
{
    protected $fillable = [
        'image_url',
        'nama',
        'kategori_id',
        'harga',
        'durasi',
        'no_tlp',
        'spesialis',
        'lokasi_praktik',
        'pukul_mulai',
        'pukul_akhir',
        'pendidikan',
        'pengalaman',
        'fokus_konsultasi',
    ];

    protected $casts = [
        'pukul_mulai' => 'datetime:H:i:s',
        'pukul_akhir' => 'datetime:H:i:s',
        'pendidikan' => 'array',
    ];

    public function kategori()
    {
        return $this->belongsTo(KonsultasiKategori::class, 'kategori_id');
    }
}
