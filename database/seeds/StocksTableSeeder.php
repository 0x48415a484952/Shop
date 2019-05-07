<?php

use Illuminate\Database\Seeder;
use App\Models\Stock;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Stock::class, 30)->create([
            'product_variation_id' => $this->getRandomProductVariationId()
        ]);
    }

    public function getRandomProductVariationId()
    {
        $productVariation = ProductVariation::inRandomOrder()->first();
        return $productVariation->id;
    }
}
