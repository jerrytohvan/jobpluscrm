<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //client
        factory(App\Models\Employees\Employee :: class, 40) -> create();
    }
}
