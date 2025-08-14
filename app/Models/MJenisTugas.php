<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MJenisTugas extends Model
{
    protected $fillable = ['user_id', 'nama'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'uid');
    }
}