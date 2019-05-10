<?php

use App\Models\Product;
use Faker\Generator as Faker;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;


$factory->define(ProductVariation::class, function (Faker $faker) {
    $product = Product::inRandomOrder()->first();
    $type = ProductVariationType::inRandomOrder()->first();
    return [
        'product_id' => $product->id,
        'title' => $faker->unique()->name,
        'product_variation_type_id' => $type->id,
        'price' => mt_rand(20000, 700000)
    ];
});
