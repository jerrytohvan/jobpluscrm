<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Users\User :: class, 20) -> create();
        factory(App\Models\Users\User :: class, 'admin') -> create();
    }
}
