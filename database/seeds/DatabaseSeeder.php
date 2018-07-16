<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(EmployeeTableSeeder::class);
        // DB::table('users') -> insert([
        //     'name' => 'yiyao',
        //     'email' =>'123@gmail.com',
        //     'password' => bcrypt('secret'),
        //     'user_type' => true
        // ]);
    }
}
