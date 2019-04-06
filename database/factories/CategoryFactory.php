<?php

use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        //'parent_id' => mt_rand(0,4),
        'title' => $title = $faker->unique()->firstName,
        'slug' => str_slug($title),
    ];
});
