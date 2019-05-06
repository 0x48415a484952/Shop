<?php

use App\Models\User;
use App\Models\Address;
use App\Models\Province;
use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    public function run()
    {
        dd(User::get());
        factory(Address::class, 30)->create()->each(function ($address) {
            $address->user()->saveMany(User::get())->make();
        });
    }

    public function getRandomUserId()
    {
        $user = User::inRandomOrder()->first();
        return $user->id;
    }

    public function getRandomProvinceId()
    {
        $province = Province::inRandomOrder()->first();
        return $province->id;
    }
}
