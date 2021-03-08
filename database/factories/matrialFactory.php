<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Matrial;
use App\Category;

use Faker\Generator as Faker;

$factory->define(Matrial::class, function (Faker $faker) {
    return [
        'name'=> $faker->randomElement(['control','analysis','programing','math','electrical']), //5
        'category_id'=> Category::all()->random()->id,

    ];
});
