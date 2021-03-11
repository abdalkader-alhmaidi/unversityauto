<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Advertisment;
use App\User;
use App\Role;
use Faker\Generator as Faker;

$factory->define(Advertisment::class, function (Faker $faker) {
    $roleId = Role::where('name','admin')->first()->id ?? 3;
    return [
        'user_id'=>User::where('role_id',$roleId)->first()->id,
        'slice'=> 'co1,co2,co3,co4,co5,po1,po2,po3,el1.el2.el3',
        'title'=> "title",
        'content'=> 'bla bla bla bla bla',
        'photo'=> null,
        //'period'=> 7,
        'status'=> 1,
    ];
});
