<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="MAsset",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="string", example="user123"),
 *     @OA\Property(property="nama", type="string", example="Sapi Holstein"),
 *     @OA\Property(
 *         property="user",
 *         ref="#/components/schemas/User"
 *     )
 * )
 */ 
class MAsset extends Model
{
    protected $fillable = ['user_id', 'nama'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }
}
