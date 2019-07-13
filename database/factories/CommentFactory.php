<?php

use Faker\Generator as Faker;
use App\Models\Comment;
use App\Models\User;
use App\Models\Product;
use App\Models\Information;

$factory->define(Comment::class, function (Faker $faker) {
    $users = User::get();
    $product = Product::inRandomOrder()->first();
    foreach($users as $user) {
        $information = Information::where('user_id', $user->id)->first();
    }
    return [
        'user_id' => $user->id,
        'product_id' => $product->id,
        'information_id' => $information->id,
        'title' => $faker->title,
        'content' => $faker->text,
    ];
});
