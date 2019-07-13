<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'title',
        'content'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        // return $this->belongsTo(User::class)->with('information');
        return $this->belongsTo(User::class);
    }

    // public function information()
    // {
    //     return $this->hasOne(Information::class);
    // }
}
