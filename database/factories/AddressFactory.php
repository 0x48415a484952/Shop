<?php

use App\Models\City;
use App\Models\User;
use App\Models\Address;
use App\Models\Province;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    $user = User::inRandomOrder()->first();
    return [
        'user_id' => $user->id,
        'recipient_name' => $faker->name,
        'address' => $faker->streetAddress,
        'postal_code' => $faker->postcode,
        'telephone' => $faker->phoneNumber,
        'province_id' => $province_id = factory(Province::class)->create()->id,
        'city_id' => factory(City::class)->create([
            'province_id' => $province_id
        ])
    ];
});
