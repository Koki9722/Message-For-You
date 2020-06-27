<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'board_title' => '投稿のタイトル',
        'board_password' => "a",
        'board_number' => $faker->numberBetween($min = 1, $max = 1000),
        'user_id' => 1,
        'sharejudge' => 0,
    ];
});
