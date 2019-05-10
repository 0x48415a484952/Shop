<?php

use Faker\Generator as Faker;
use App\Models\Comment;
use App\Models\User;
use App\Models\Product;

$factory->define(Comment::class, function (Faker $faker) {
    $user = User::inRandomOrder()->first();
    $product = Product::inRandomOrder()->first();
    return [
        'user_id' => $user->id,
        'product_id' => $product->id,
        'title' => $faker->title,
        'content' => $faker->text,
    ];
});
