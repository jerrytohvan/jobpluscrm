<?php

use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Clients\Company :: class, 15) -> create();
        factory(App\Models\Clients\Company :: class, 20) -> create(['client' => 1]);
    }
}
