<?php

use Faker\Generator as Faker;
use App\Models\Comment;
use App\Models\User;
use App\Models\Product;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'product_id' => factory(Product::class)->create()->id,
        'title' => $faker->title,
        'content' => $faker->text,
    ];
});
