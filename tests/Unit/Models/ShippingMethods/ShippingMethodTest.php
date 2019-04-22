<?php

namespace Tests\Unit\Models\ShippingMethods;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ShippingMethod;
use App\Cart\Money;

class ShippingMethodTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_it_returns_a_money_instance_for_the_price()
    {
        $shipping = factory(ShippingMethod::class)->create();
        $this->assertInstanceOf(Money::class, $shipping->price);
    }
}
