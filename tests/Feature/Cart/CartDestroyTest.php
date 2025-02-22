<?php

namespace Tests\Feature\Cart;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\ProductVariation;

class CartDestroyTest extends TestCase
{
    public function test_it_fails_if_User_is_unauthenticated()
    {
        $this->json('DELETE', 'api/cart/1')
            ->assertStatus(401);
    }

    public function test_it_if_a_product_cant_be_found()
    {
        $user = factory(User::class)->create();
        $this->jsonAs($user, 'DELETE', 'api/cart/1')
            ->assertStatus(404);
    }

    public function test_it_delete_a_product_from_the_cart()
    {
        $user = factory(User::class)->create();

        $user->cart()->sync(
            $product = factory(ProductVariation::class)->create()
        );

        $this->jsonAs($user, 'DELETE', "api/cart/{$product->id}");

        $this->assertDatabaseMissing('cart_user', [
            'product_variation_id' => $product->id
        ]);
    }
}
