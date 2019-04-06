<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'province_id',
        'city_name_fa',
        'city_name_en',
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
