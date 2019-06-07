<?php

use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Database\Seeder;
// use Faker\Provider\Image;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Product::get();
        foreach($products as $product) {
            factory(ProductImages::class)->create([
                'product_id' => $product->id,
            ]);
            // ProductImages::create([
            //         'product_id' => $product->id,
            //         'url' => $faker->image('public/storage/images',500,500, null, false)
            //     ]);

            // dd(factory(ProductImages::class)->create([
            //     'product_id' => $product->id,
            // ]));
        }
    }
}
