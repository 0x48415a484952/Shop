<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::get();
        foreach($users as $user) {
            factory(Comment::class, 30)->create([
                'user_id' => $user->id,
                'product_id' => $this->getRandomProductId()
            ]);
        }
    }

    public function getRandomProductId()
    {
        $product = Product::inRandomOrder()->first();
        return $product->id;
    }
}
