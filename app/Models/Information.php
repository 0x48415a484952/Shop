<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $table = 'information';
    public function user()
    {
        return $this->BelongsTo(User::class);
    }

    public function comments()
    {
        return $this->belongsTo(Comment::class);
    }
}
