<?php

use App\Models\User;
use App\Models\Information;
use Faker\Generator as Faker;

$factory->define(Information::class, function (Faker $faker) {
    $user = User::inRandomOrder()->first();
    return [
        'user_id' => $user->id,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'job' => $faker->jobTitle,
        'birth_date' => $faker->dateTimeBetween('-30 years', 'now')->format('Y-m-d H:i:s'),
        'image' => '/',
        'level' => '1'
    ];
});
