<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'province_name_fa',
        'province_name_en'
    ];

    public function city()
    {
        return $this->hasMany(City::class);
    }
}
