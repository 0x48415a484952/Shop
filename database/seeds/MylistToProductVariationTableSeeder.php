<?php

use Illuminate\Database\Seeder;
use App\Models\ProductVariation;
use App\Models\Mylist;

class MylistToProductVariationTableSeeder extends Seeder
{
    public function run()
    {
        return [
            'product_variation_id' => $this->getRandomProductVariationId(),
            'mylist_id' => $this->getRandomListId()
        ];
        
    }

    public function getRandomProductVariationId()
    {
        $productVariation = ProductVariation::inRandomOrder()->first();
        return $productVariation->id;
    }

    public function getRandomListId()
    {
        $list = Mylist::inRandomOrder()->first();
        return $list->id;
    }
}
