<?php

namespace Tests\Unit\Cart;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Cart\Cart;
use App\Models\ProductVariation;
use App\Cart\Money;

class CartTest extends TestCase
{
    public function test_it_can_add_products_to_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $product = factory(ProductVariation::class)->create();

        $cart->add([
            ['quantity' => 1, 'id' => $product->id]
        ]);

        $this->assertCount(1, $user->fresh()->cart);
    }

    public function test_it_can_increment_products_quantity_when_adding_more_products()
    {

        $product = factory(ProductVariation::class)->create();

        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $cart->add([
            ['quantity' => 1, 'id' => $product->id]
        ]);

        $cart = new Cart($user->fresh() );

        $cart->add([
            ['quantity' => 1, 'id' => $product->id]
        ]);

        $this->assertEquals($user->fresh()->cart->first()->pivot->quantity, 2);
    }

    public function test_it_can_update_quantities_in_the_cart()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create(), [
                'quantity' => 1
            ]
        );

        $cart->update($product->id, 2);

        $this->assertEquals($user->fresh()->cart->first()->pivot->quantity, 2);
    }

    public function test_it_can_delete_a_product_from_cart ()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            $product = factory(ProductVariation::class)->create()
        );

        $cart->delete($product->id);

        //this one is HAZHIR AHMADZADEH way
        // $this->assertDatabaseMissing('cart_user', [
        //     'user_id' => $user->id,
        //     'product_variation_id' => $product->id,
        //     'quantity' => $quantity
        // ]);

        //this one is working too but less code so i think this one maybe better instead of the above code
        $this->assertCount(0, $user->fresh()->cart);
    }

    public function test_it_can_empty_the_cart()
    {
        $user = factory(User::class)->create();
        $cart = new Cart($user);

        $user->cart()->attach(
            factory(ProductVariation::class)->create()
        );

        $cart->empty();

        $this->assertCount(0, $user->fresh()->cart);
    }

    public function test_it_can_check_if_the_cart_is_empty_of_quantities()
    {
        $user = factory(User::class)->create();
        $cart = new Cart($user);

        $user->cart()->attach(
            factory(ProductVariation::class)->create(), [
                'quantity' => 0
            ]
        );

        $this->assertTrue($cart->isEmpty());
    }

    public function test_it_returns_a_money_istance_for_the_subtotal()
    {
        $user = factory(User::class)->create();
        $cart = new Cart($user);

        $this->assertInstanceOf(Money::class, $cart->subtotal());
    }

    public function test_it_gets_the_correct_subtotal()
    {
        $cart = new Cart(
            $user = factory(User::class)->create()
        );

        $user->cart()->attach(
            factory(ProductVariation::class)->create([
                'price' => 10000
            ]), 
            [
                'quantity' => 2
            ]
        );

        $this->assertEquals($cart->subtotal()->amount(), 20000);
    }

    public function test_it_returns_a_money_istance_for_the_total()
    {
        $user = factory(User::class)->create();
        $cart = new Cart($user);

        $this->assertInstanceOf(Money::class, $cart->total());
    }

    public function test_it_sync_the_cart_to_update_quantities()
    {
        $user = factory(User::class)->create();
        $cart = new Cart($user);

        $user->cart()->attach(
            factory(ProductVariation::class)->create(), [
                'quantity' => 4
            ]
        );

        //we have not gave this product any stock amount so after syncing we should end up with 0 quantity
        $cart->sync();
        $this->assertEquals($user->fresh()->cart->first()->pivot->quantity, 0);
    }

    public function test_it_can_check_the_cart_is_changed_after_syncing()
    {
        $user = factory(User::class)->create();
        $cart = new Cart($user);

        $user->cart()->attach(
            factory(ProductVariation::class)->create(), [
                'quantity' => 4
            ]
        );

        //we have not gave this product any stock amount so after syncing we should end up with 0 quantity
        $cart->sync();
        $this->assertTrue($cart->hasChanged());
    }
}
