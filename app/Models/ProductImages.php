<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    public function Product()
    {
        $this->belongsTo(Product::class);
    }
}
