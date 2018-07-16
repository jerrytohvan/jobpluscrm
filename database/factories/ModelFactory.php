<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'admin' => false,
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(App\Models\User::class, 'admin', function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'admin' => true,
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Employees\Employee::class, function (Faker\Generator $faker) {
    return [
        'company_name' => $faker->company,
        'name' => $faker->name,
        'handphone' => $faker ->phoneNumber,
        'telephone' => $faker ->phoneNumber
    ];
});
