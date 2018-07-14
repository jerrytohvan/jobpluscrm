<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;


class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
    public function run()
    {
        $faker = Faker\Factory::create();
        //create admin
        $user = factory(User::class)->create();

    }
}
