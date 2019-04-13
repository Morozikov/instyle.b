<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' =>  \Illuminate\Support\Facades\Hash::make('123'), // password
        'remember_token' => Str::random(10),
        'api_token' => Str::random(60),
    ];
});

$factory->define(\App\UserData::class, function (Faker $faker){

  return[
       'city_id' => '1',
       'first_name' => $faker->firstName,
       'last_name' => $faker->lastName,
       'birthday' => $faker->date('Y-m-d'),
       'phone' => $faker->phoneNumber,
   ];
});
