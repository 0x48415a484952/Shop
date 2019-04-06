<?php

use Faker\Generator as Faker;
use App\Models\Stock;
use App\Models\Product;

$factory->define(Stock::class, function (Faker $faker) {
    return [
        'quantity' => $faker->numberBetween(50, 300),
        'product_variation_id' => factory(Product::class)->create()->id
    ];
});
