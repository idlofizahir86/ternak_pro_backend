<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public $timestamps = false;  // Menonaktifkan penggunaan created_at dan updated_at

    protected $fillable = [
        'user_id',
        'chat_content',
        'response_text',
        'href',
        'sender_type',
        'timestamp',
    ];

    protected $casts = [
        'sender_type' => 'string',
        'timestamp' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }
}
