<?php

use Illuminate\Database\Seeder;
use App\Models\Mylist;

class MylistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Mylist::class, 3)->create();
    }
}
