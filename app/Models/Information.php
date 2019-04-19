<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    public function user()
    {
        return $this->BelongsTo(User::class);
    }
}
