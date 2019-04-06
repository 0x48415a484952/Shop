<?php

namespace Tests\Feature\Addresses;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Province;
use App\Models\City;
use function GuzzleHttp\json_decode;

class AddressStoreTest extends TestCase
{
    public function test_it_fails_if_unauthenticated()
    {
        $this->json('POST', 'api/addresses')
            ->assertStatus(401);
    }

    public function test_it_requires_province_id()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user, 'POST', 'api/addresses')
            ->assertJsonValidationErrors([
                'province_id'
            ]);
    }

    public function test_it_requires_a_valid_province_id()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user, 'POST', 'api/addresses', [
            'province_id' => 9999
        ])
            ->assertJsonValidationErrors([
                'province_id'
            ]);
    }

    public function test_it_requires_city_id()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user, 'POST', 'api/addresses')
            ->assertJsonValidationErrors([
                'city_id'
            ]);
    }

    public function test_it_requires_a_valid_city_id()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user, 'POST', 'api/addresses', [
            'city_id' => 9999
        ])
            ->assertJsonValidationErrors([
                'city_id'
            ]);
    }

    public function test_it_requires_recipient_name()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user, 'POST', 'api/addresses')
            ->assertJsonValidationErrors([
                'recipient_name'
            ]);
    }

    public function test_it_requires_a_postal_code()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user, 'POST', 'api/addresses')
            ->assertJsonValidationErrors([
                'postal_code'
            ]);
    }

    public function test_it_requires_a_telephone()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user, 'POST', 'api/addresses')
            ->assertJsonValidationErrors([
                'telephone'
            ]);
    }

    public function test_it_stores_an_address()
    {
        $user = factory(User::class)->create();

        $province = factory(Province::class)->create();
        $city = factory(City::class)->create();

        $this->jsonAs($user, 'POST', 'api/addresses', $payload = [
            'province_id' => $province->id,
            'city_id' => $city->id,
            'recipient_name' =>'Hazhir',
            'address' => 'Mahabad 4 rahe azadi vahede F15',
            'postal_code' => '1234567891',
            'telephone' => '00989354584063'
        ]);


        $this->assertDatabaseHas('addresses', array_merge($payload, [
            'user_id' => $user->id
        ]));
    }

    public function test_it_returns_an_address_after_creating()
    {
        $user = factory(User::class)->create();

        $province = factory(Province::class)->create();
        $city = factory(City::class)->create();

        $response = $this->jsonAs($user, 'POST', 'api/addresses', $payload = [
            'province_id' => $province->id,
            'city_id' => $city->id,
            'recipient_name' =>'Hazhir',
            'address' => 'Mahabad 4 rahe azadi vahede F15',
            'postal_code' => '1234567891',
            'telephone' => '00989354584063'
        ]);

        $response->assertJsonFragment([
            'id' => json_decode($response->getContent())->data->id
        ]);
    }
}
