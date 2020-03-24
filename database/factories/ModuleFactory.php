<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ModelsModule;
use Faker\Generator as Faker;

$factory->define(\App\Models\Module::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'short_name' => $faker->word,
        'block' => $faker->numberBetween(0, 10),
    ];
});
