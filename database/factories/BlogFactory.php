<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'content' => $faker->text($minNbChars = 2500, $maxNbChars = 10000),
        'stars' => $faker->numberBetween($min = 0, $max = 100000),
        'user_id' => $faker->numberBetween($min = 1, $max = User::count()),
    ];
});
