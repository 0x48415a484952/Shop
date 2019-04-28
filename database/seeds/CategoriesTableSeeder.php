<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 30)->create();
        $categories = $this->getCategories();
        $count = 3;
        foreach($categories as $category) {
                if ($category->id % 5 != 0) {
                    Category::where('id', $category->id)
                        ->update(['parent_id' => $category->id + 1]);
                    if($category->id == $count) {
                        Category::where('id', $category->id)
                            ->update(['parent_id' => 4]);
                        $count += 5;
                    }
                }  else { 
                    
                    if($category->id != 5)
                    Category::where('id', $category->id)
                        ->update(['parent_id' => 5]);
                }
        }
        
    }

    public function getCategories()
    {
        $categories = Category::get();
        return $categories;
    }
}
