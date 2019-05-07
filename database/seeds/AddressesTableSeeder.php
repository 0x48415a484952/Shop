<?php

use App\Models\User;
use App\Models\Address;
use App\Models\Province;
use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    public function run()
    {
        factory(Address::class, 30)->create([
            'user_id' => 1,
            'province_id' => 20
        ]);
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
