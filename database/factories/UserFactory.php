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
        'social_id' => '5311347678',
        'phone' => '09354584063',
        'phone_verification_code' => mt_rand(10000, 99999),
        'phone_verified_at' => now(),
        'password' => 'hazaa',
        'remember_token' => str_random(10),
    ];
});
