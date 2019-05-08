<?php

use App\Models\Stock;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\ProductVariation;
use App\Models\ProductVariationType;

class ProductVariationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::get();
        
        $types = $this->getProductVariationTypeIds();
        $i = 0;
        foreach($products as $product) {
            factory(ProductVariation::class, 30)->create([
                'product_id' => $product->id,
                'product_variation_type_id' => $types[$i]
            ])->each(function ($productVariation) {
                $productVariation->stocks()->save(factory(Stock::class)->create())->make();
            });
            $i++;
        }
        
    }

    public function getProductVariationTypeIds()
    {
        $types = [];
        $productVariationTypes = ProductVariationType::get();
        foreach($productVariationTypes as $key => $type) {
            $types[$key] = $type->id;
        }
        return $types;
    }
}
