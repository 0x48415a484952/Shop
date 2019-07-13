<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        // $faker->image('public/storage/images',500,500);
        $this->call(UsersTableSeeder::class);
        // $this->call(InformationTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductVariationTypesTableSeeder::class);
        $this->call(ProductVariationsTableSeeder::class);
        $this->call(MylistsTableSeeder::class);
        // $this->call(CommentTableSeeder::class);
        $this->call(ImageTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        Model::reguard();
    }
}
