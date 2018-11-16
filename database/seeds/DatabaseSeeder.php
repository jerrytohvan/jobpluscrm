<?php

use Illuminate\Database\Seeder;
use App\Models\MachineLearning\MLService;

class DatabaseSeeder extends Seeder
{
    public function __construct()
    {
        $this->svc = app(MLService::class);
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        // $this->call(EmployeesTableSeeder::class);
        //$this->call(ProjectGroupsTableSeeder::class);
        //$this->call(CandidatessTableSeeder::class);
        // $this->call(ResultsTableSeeder::class);
        // $this->call(InterestsTableSeeder::class);
        // $this->call(FieldsTableSeeder::class);
        // $this->call(MessagesTableSeeder::class);
        // $this->call(LikesTableSeeder::class);
        // $this->svc->setDataIntoDB(public_path()  . '/data_samples.csv');
    }
}
