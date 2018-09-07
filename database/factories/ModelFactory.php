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
use App\Models\Messages\Message;
use App\Models\Likes\Like;
use Faker\Generator;

$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(str_random(10)),
        'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'profile_pic' => Gravatar::src($faker->safeEmail, 200),
        'admin' => false,
        'remember_token' => str_random(10),
    ];
});

$factory->defineAs(User::class, 'admin', function (Faker\Generator $faker) {
    return [
        'name' => 'Administrator',
        'email' =>'admin@jobpluscrm.com',
        'password' => bcrypt('admin'),
        'birth_date' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'profile_pic' => Gravatar::src('admin@jobpluscrm.com', 200),
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

// $factory->define(Post::class, function (Faker\Generator $faker) {
//     $user = factory(User::class)->create();
//     return [
//         'content' => $faker->sentence,
//         'user_id' => $user->id,
//     ];
// });

$factory->define(Employee::class, function (Faker\Generator $faker) {
    $companies = Company::all()->pluck('id')->toArray();
    return [
        'name' => $faker->name,
        'title' => $faker->title,
        'handphone' => $faker->phoneNumber,
        'email' => $faker->companyEmail,
        'telephone' => $faker->phoneNumber,
        'company_id' => array_rand($companies, 1)
    ];
});

// $factory->define(ProjectGroup::class, function (Faker\Generator $faker) {
//     $user = factory(User::class)->create();
//     return [
//         'group_name' => $faker->unique()->name,
//         'admin_id' => $faker->randomDigit,
//         'user_id' => $user->id,
//     ];
// });

$factory->define(Candidate::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->unique()->name,
        'email' => $faker->companyEmail,
        'handphone' => $faker->phoneNumber,
        'working_experience' => $faker->randomDigit,
        'graduation_year' => $faker->randomDigit,
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

$factory->define(Message::class, function (Faker\Generator $faker) {
    return [
        'message_content' => $faker->text($maxNbChars = 200),
        'sender_id' => $faker->randomDigit,
        'receiver_id' => $faker->randomDigit,
        'broadcast' => $faker->randomLetter
    ];
});

$factory->define(Like::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->randomDigit,
        'post_id' => $faker->randomDigit,
        'comment_id' => $faker->randomDigit,
        'like' => true
    ];
});
