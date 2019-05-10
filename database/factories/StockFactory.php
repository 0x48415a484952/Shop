<?php

use App\Models\Stock;
use Faker\Generator as Faker;
use App\Models\ProductVariation;

$factory->define(Stock::class, function (Faker $faker) {
    $productVariation = ProductVariation::inRandomOrder()->first();
    return [
        'quantity' => $faker->numberBetween(50, 300),
        'product_variation_id' => $productVariation->id
    ];
});
