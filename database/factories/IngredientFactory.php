<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ingredient;
use Faker\Generator as Faker;

$factory->define(Ingredient::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'cost' => $faker->numberBetween(1, 20)*10
    ];
});
