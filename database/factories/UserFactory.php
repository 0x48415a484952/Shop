<?php

use Faker\Generator as Faker;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    
    return [
        'social_id' => $faker->numberBetween(3720558372, 9392935689),
        'phone' => $faker->phoneNumber,
        'phone_verification_code' => mt_rand(10000, 99999),
        'phone_verified_at' => now(),
        'password' => 'password12',
        'remember_token' => str_random(10),
    ];
});

