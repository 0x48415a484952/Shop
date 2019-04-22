<?php

use Illuminate\Database\Seeder;
use App\Models\ProductVariation;

class ProductVariationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductVariation::class)->create();
    }
}
