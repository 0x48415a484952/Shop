<?php

namespace Tests\Unit\Models\Addresses;

use Tests\TestCase;
use App\Models\City;
use App\Models\User;
use App\Models\Address;

class AddressTest extends TestCase
{
    public function test_it_has_one_city()
    {
        $address = factory(Address::class)->create([
            'user_id' => factory(User::class)->create()->id
        ]);

        $this->assertInstanceOf(City::class, $address->city);
    }

    public function test_it_belongs_to_a_user()
    {
        $address = factory(Address::class)->create([
            'user_id' => factory(User::class)->create()->id
        ]);

        $this->assertInstanceOf(User::class, $address->user);
    }

    public function test_it_sets_old_addresses_to_not_default_when_creating()
    {
        $user = factory(User::class)->create();

        $oldAddress = factory(Address::class)->create([
            'default' => true,
            'user_id' => $user->id
        ]);

        factory(Address::class)->create([
            'default' => true,
            'user_id' => $user->id
        ]);

        $this->assertFalse($oldAddress->fresh()->default);
    }
}
