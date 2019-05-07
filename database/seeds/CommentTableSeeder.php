<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    public function run()
    {
        factory(Comment::class, 30)->create([
            'user_id' => $this->getRandomUserId(),
            'product_id' => $this->getRandomProductId()
        ]);
    }

    public function getRandomUserId()
    {
        $user = User::inRandomOrder()->first();
        return $user->id;
    }

    public function getRandomProductId()
    {
        $product = Product::inRandomOrder()->first();
        return $product->id;
    }
}
