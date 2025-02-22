<?php

use Faker\Generator as Faker;
use App\Models\ProductVariationType;

$factory->define(ProductVariationType::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->name
    ];
});
