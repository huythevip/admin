<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->sentence,
        'member_id' => $faker->numberBetween(8, 9),
    ];
});
