<?php

namespace Tests\Feature\Provinces;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Province;

class ProvinceIndexTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_returns_provinces()
    {
        $province = factory(Province::class)->create();

        $this->json('GET', 'api/provinces')
            ->assertJsonFragment([
                'province_id' => $province->id
            ]);
    }
}
