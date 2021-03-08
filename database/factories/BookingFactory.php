<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Room;
use App\Category;
use App\Matrial;
use App\User;
use App\Role;


use App\Booking;
use Faker\Generator as Faker;

$factory->define(Booking::class, function (Faker $faker) {
    return [
        'room_id'=> Room::all()->random()->id ,
        'user_id'=> Role::where('name','doctor')->first()->users()->first()->id ,
        'category_id'=> Category::all()->random()->id ,
        'matrial_id'=> Matrial::all()->random()->id ,
        
    ];
});
