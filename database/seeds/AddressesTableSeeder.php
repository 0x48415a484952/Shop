<?php

use App\Models\User;
use App\Models\Address;
use App\Models\Province;
use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    public function run()
    {
        factory(Address::class, 30)->create();
    }
}
