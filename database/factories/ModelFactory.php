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
use Faker\Generator;
use App\Models\Users\User;
use App\Models\Posts\Post;
use App\Models\Clients\Company;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'admin' => false,
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(User::class, 'admin', function (Faker\Generator $faker) {
    return [
        'name' => 'admin',
        'email' =>'admin@jobpluscrm.com',
        'password' => bcrypt('admin'),
        'admin' => true,
        'remember_token' => str_random(10),
    ];
});

$factory->define(Company::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->companyEmail,
        'address' => $faker->address,
        'fax_no' => $faker ->phoneNumber,
        'telephone_no' => $faker ->phoneNumber
    ];
});

$factory->define(Post::class, function (Faker\Generator $faker) {
    $user =  factory(User::class)->create();
    return [
        'content' => $faker->sentence,
        'user_id' => $user->id
    ];
});
