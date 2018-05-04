<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'like' => $faker->numberBetween(0, 100),
        'member_id' => $faker->numberBetween(8, 9),
    ];
});
