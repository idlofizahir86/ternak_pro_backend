<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @OA\Schema(
 *     schema="User",
 *     type="object",
 *     @OA\Property(property="uid", type="string", example="user123"),
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
 *     @OA\Property(property="role_id", type="integer", example=1),
 *     @OA\Property(property="no_telepon", type="string", example="+6281234567890"),
 *     @OA\Property(property="profile_image", type="string", example="/images/profile.jpg"),
 *     @OA\Property(property="email_verified_at", type="string", format="date-time", example="2025-08-20T12:00:00Z"),
 *     @OA\Property(
 *         property="role",
 *         ref="#/components/schemas/Role"
 *     )
 * )
 */
class User extends Authenticatable
{
   use HasFactory, Notifiable, HasApiTokens;

    protected $primaryKey = 'uid';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
        'uid',
        'role_id',
        'no_telepon', // Tambahkan no_telepon
        'profile_image', // Tambahkan profile_image
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}

