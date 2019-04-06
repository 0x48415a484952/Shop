<?php

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $title = $faker->unique()->name,
        'slug' => str_slug($title),
        'description' => $faker->sentence(5),
        'price' => mt_rand(20000, 700000),
        'discount' => null,
    ];
});
