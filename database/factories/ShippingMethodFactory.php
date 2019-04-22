<?php

use Faker\Generator as Faker;
use App\Models\ShippingMethod;

$factory->define(ShippingMethod::class, function (Faker $faker) {
    return [
        'name' => 'post',
        'price' => 10000
    ];
});
