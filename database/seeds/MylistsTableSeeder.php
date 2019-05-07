<?php

use App\Models\Mylist;
use Illuminate\Database\Seeder;
use App\Models\ProductVariation;

class MylistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Mylist::class, 21)->create()->each(function ($mylist) {
            $mylist->items()->saveMany(ProductVariation::get())->make();
        });
    }
}
