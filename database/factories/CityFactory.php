<?php

use Faker\Generator as Faker;
use App\Models\City;
use App\Models\Province;

$factory->define(City::class, function (Faker $faker) {
    return [
        'province_id' => factory(Province::class)->create()->id,
        'city_name_fa' => 'سنندج',
        'city_name_en' => 'sanandaj'
    ];
});
