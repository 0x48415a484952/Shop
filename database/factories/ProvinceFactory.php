<?php

use Faker\Generator as Faker;
use App\Models\Province;

$factory->define(Province::class, function (Faker $faker) {
    return [
        'province_name_fa' => 'کردستان',
        'province_name_en' => 'kurdistan'
    ];
});
