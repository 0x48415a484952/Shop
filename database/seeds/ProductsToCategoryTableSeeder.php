<?php

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductsToCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return [
            'product_id' => $this->getRandomProductsId(),
            'category_id' => $this->getRandomCategoriesId()
        ];
        
    }

    public function getRandomProductsId()
    {
        $product = Product::inRandomOrder()->first();
        return $product->id;
    }

    public function getRandomCategoriesId()
    {
        $category = Category::inRandomOrder()->first();
        return $category->id;
    }
}
