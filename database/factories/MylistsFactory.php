<?php

use Faker\Generator as Faker;
use App\Models\Mylist;

$factory->define(Mylist::class, function (Faker $faker) {
    return [
        'title' => $faker->name
    ];
});
