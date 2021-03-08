<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Room;
use App\Category;

use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'name'=> $faker->unique()->randomElement(['computer 1','computer 2','computer 3','computer 4',
                                                  'computer 5','computer6','computer7','computer8',
                                                  'electron 1','electron 2','electron3','electron4',]), //12
        'category_id'=> Category::all()->random()->id,
        'capacity'=>  $faker->randomElement([100,50,200]),
 ];
});
