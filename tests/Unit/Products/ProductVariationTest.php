<?php

namespace Tests\Unit\Products;

use App\Cart\Money;
use Tests\TestCase;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Stock;

class ProductsVariationTest extends TestCase
{
    public function test_it_has_one_variation_type()
    {
        $variation = factory(ProductVariation::class)->create();

        $this->assertInstanceOf(ProductVariationType::class, $variation->type);
    }

    public function test_it_has_belongs_to_a_product()
    {
        $variation = factory(ProductVariation::class)->create();

        $this->assertInstanceOf(Product::class, $variation->product);
    }

    public function test_it_returns_a_money_instance_for_the_price()
    {
        $variation = factory(ProductVariation::class)->create();
        $this->assertInstanceOf(Money::class, $variation->price);
    }
    
    public function test_it_returns_a_fromatted_price()
    {
        $variation = factory(ProductVariation::class)->create([
            'price' => 10000
        ]);
        $this->assertEquals($variation->formattedPrice, 'ریال۱۰٬۰۰۰');
    }

    public function test_it_returns_the_product_price_if_variation_price_is_null()
    {
        $product = factory(Product::class)->create([
            'price' => 10000
        ]);

        $variation = factory(ProductVariation::class)->create([
            'price' => null,
            'product_id' => $product->id
        ]);

        $this->assertEquals($product->price->amount(), $variation->price->amount());
    }

    public function test_it_can_check_if_the_product_variation_price_is_different_to_the_product()
    {
        $product = factory(Product::class)->create([
            'price' => 10000
        ]);

        $variation = factory(ProductVariation::class)->create([
            'price' => 20000,
            'product_id' => $product->id
        ]);

        $this->assertTrue($variation->priceVaries());
    }

    public function test_it_has_many_stocks()
    {

        //this one is my way

        // $product = factory(Product::class)->create();

        // $variation = factory(ProductVariation::class)->create([
        //     'price' => 10000,
        //     'product_id' => $product->id
        // ]);

        // $stock = factory(Stock::class)->create([
        //     'quantity' => 100,
        //     'product_variation_id' => $variation->id
        // ]);

        // $this->assertInstanceOf(Stock::class, $stock);
        //end of my way

        $variation = factory(ProductVariation::class)->create();
        
        $variation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertInstanceOf(Stock::class, $variation->stocks->first());

    }

    public function test_it_has_stock_information()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertInstanceOf(ProductVariation::class, $variation->stock->first());
    }

    public function test_it_has_stock_count_pivot_within_stock_information()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantity = 5
            ])
        );

        $this->assertEquals($variation->stock->first()->pivot->stock, $quantity);
    }

    public function test_it_has_in_stock_pivot_within_stock_information()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make()
        );

        $this->assertTrue($variation->inStock());
    }

    public function test_it_can_get_stock_count()
    {
        $variation = factory(ProductVariation::class)->create();

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => 5
            ])
        );

        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => 5
            ])
        );

        $this->assertEquals($variation->stockCount(), 10);
    }

    public function test_it_can_give_a_minimum_stock_for_a_given_value()
    {
        $variation = factory(ProductVariation::class)->create();
        $variation->stocks()->save(
            factory(Stock::class)->make([
                'quantity' => $quantity = 10
            ])
        );

        $this->assertEquals($variation->minStock(400), $quantity);
    }
}
