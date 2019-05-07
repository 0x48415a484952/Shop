<?php

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    public function run()
    {
<<<<<<< HEAD
        factory(Comment::class, 50)->create([
=======
        factory(Comment::class, 30)->create([
>>>>>>> 462f582b1aa45afb3d7d8e74a702e4c9266a77f7
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
