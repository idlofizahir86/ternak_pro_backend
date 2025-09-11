<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TNotification extends Model
{
    use HasFactory;

    protected $table = 't_notifications';

    protected $fillable = [
        'title',
        'content',
        'iconPath',
        'user_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }
}
