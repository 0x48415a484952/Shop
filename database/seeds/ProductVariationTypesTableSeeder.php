<?php

use Illuminate\Database\Seeder;
use App\Models\ProductVariationType;

class ProductVariationTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductVariationType::class, 30)->create();
    }
}
