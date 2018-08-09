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
use App\Models\Clients\Candidate;
use App\Models\Clients\Company;
use App\Models\Employees\Employee;
use App\Models\Posts\Post;
use App\Models\ProjectGroups\ProjectGroup;
use App\Models\Results\Result;
use App\Models\Users\User;
use App\Models\Interests\Interest;
use App\Models\Fields\Field;
use Faker\Generator;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(str_random(10)),
        'admin' => false,
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(User::class, 'admin', function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->email,
        'password' => bcrypt("password"),
        'admin' => true,
        'remember_token' => str_random(10),
    ];
});

$factory->define(Company::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->companyEmail,
        'address' => $faker->address,
        'fax_no' => $faker->phoneNumber,
        'telephone_no' => $faker->phoneNumber,
    ];
});

$factory->define(Post::class, function (Faker\Generator $faker) {
    $user = factory(User::class)->create();
    return [
        'content' => $faker->sentence,
        'user_id' => $user->id,
    ];
});

$factory->define(Employee::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'title' => $faker->name,
        'handphone' => $faker->phoneNumber,
        'email' => $faker->companyEmail,
        'telephone' => $faker->phoneNumber,
        'company_id' => $faker->randomDigit,
    ];
});

$factory->define(ProjectGroup::class, function (Faker\Generator $faker) {
    $user = factory(User::class)->create();
    return [
        'group_name' => $faker->unique()->name,
        'admin_id' => $faker->randomDigit,
        'user_id' => $user->id,
    ];
});

$factory->define(Candidate::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->name,
        'email' => $faker->companyEmail,
        'handphone' => $faker->phoneNumber,
        'interest_id' => $faker->randomDigit,
        'type' => false,
        'field_id' =>$faker ->randomDigit
    ];
});

$factory->define(Result::class, function (Faker\Generator $faker) {
    return [
        'interest_id' => $faker->randomDigit,
        'field_id' =>  $faker->randomDigit,
        'candidate_id' =>  $faker->randomDigit,
        'user_id' =>  $faker->randomDigit,
        'project_group_id' =>  $faker->randomDigit
    ];
});

$factory->define(Interest::class, function (Faker\Generator $faker) {
    return [
        'interest_name' => $faker->jobTitle
    ];
});

$factory->define(Field::class, function (Faker\Generator $faker) {
    return [
        'interest_id' => $faker->randomDigit,
        'field_name' => $faker->jobTitle
    ];
});



