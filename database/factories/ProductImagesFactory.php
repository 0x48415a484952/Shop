<?php

use App\Models\Product;
use App\Models\ProductImages;
use Faker\Generator as Faker;

$factory->define(ProductImages::class, function (Faker $faker) {
    $product = Product::get()->first();
    return [
        'product_id' => $product->id,
        'url' => $faker->image('public/storage',500, 500, null, false)
        // 'url' => 'public/storage/iphone.jpg'
    ];
});
