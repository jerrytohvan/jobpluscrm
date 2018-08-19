<?php

use Illuminate\Database\Seeder;

class CandidatessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\Clients\Candidate :: class, 20) -> create();
    }
}
