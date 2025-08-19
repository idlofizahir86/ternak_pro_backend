<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Role",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="nama_role", type="string", example="Admin"),
 *     @OA\Property(property="is_aktif", type="boolean", example=true),
 *     @OA\Property(
 *         property="users",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/User")
 *     )
 * )
 */
class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_role',
        'is_aktif',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

