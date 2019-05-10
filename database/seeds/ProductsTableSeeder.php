<?php

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Product::class, 30)->create()->each(function ($product) {
            $product->categories()->saveMany(Category::get())->make();
        });
    }
}
