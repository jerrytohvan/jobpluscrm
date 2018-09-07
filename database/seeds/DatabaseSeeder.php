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
        $this->call(CompaniesTableSeeder::class);
        //$this->call(EmployeesTableSeeder::class);
        //$this->call(ProjectGroupsTableSeeder::class);
        //$this->call(CandidatessTableSeeder::class);
        $this->call(ResultsTableSeeder::class);
        $this->call(InterestsTableSeeder::class);
        $this->call(FieldsTableSeeder::class);
        //$this->call(MessagesTableSeeder::class);
        //$this->call(LikesTableSeeder::class);

    }
}
