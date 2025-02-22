<?php

namespace App\Models;

use App\Cart\Money;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Traits\HasPrice;
use App\Models\ProductVariationType;
use Illuminate\Database\Eloquent\Model;
use App\Models\Collections\ProductVariationCollection;

class ProductVariation extends Model
{
    use HasPrice;

    public function getPriceAttribute($value)
    {
        if ($value === null) {
            return $this->product->price;
        }

        return new Money($value);
    }

    public function minStock($count)
    {
        return min($this->stockCount(), $count);
    }

    public function priceVaries()
    {
        return $this->price->amount() !== $this->product->price->amount();
    }

    public function stockCount()
    {
        return $this->stock->sum('pivot.stock');
    }

    public function inStock()
    {
        return $this->stockCount() > 0;
    }

    public function type()
    {
        return $this->hasOne(ProductVariationType::class, 'id', 'product_variation_type_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function stock()
    {
        return $this->belongsToMany(
            ProductVariation::class, 'product_variation_stock_view'
        )
            ->withPivot([
                'stock',
                'in_stock'
            ]);
    }

    public function lists()
    {
        return $this->belongsToMany(Mylist::class);
    }


    //this is used with the forsyncing method in order controllers and the productvariationcollection class
    public function newCollection(array $models = [])
    {
        return new ProductVariationCollection($models);
    }


    // public function orders()
    // {
    //     return $this->belongsToMany(Order::class)->withPivot(['quantity']);
    // }
}
