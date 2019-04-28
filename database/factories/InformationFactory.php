<?php

use App\Models\User;
use App\Models\Information;
use Faker\Generator as Faker;

$factory->define(Information::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'job' => $faker->jobTitle,
        'birth_date' => $faker->dateTimeBetween('-30 years', 'now')->format('Y-m-d H:i:s'),
        'image' => '/',
        'level' => '1'
    ];
});
