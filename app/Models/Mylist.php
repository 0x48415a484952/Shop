<?php

namespace App\Models;

use App\Cart\Money;
use App\Models\Traits\HasPrice;
use App\Models\ProductVariation;
use Illuminate\Database\Eloquent\Model;

class Mylist extends Model
{
    public function items() 
    {
        return $this->belongsToMany(ProductVariation::class);
    }
}
