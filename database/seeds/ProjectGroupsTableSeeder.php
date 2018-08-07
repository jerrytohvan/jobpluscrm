<?php

use Illuminate\Database\Seeder;

class ProjectGroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Models\ProjectGroups\ProjectGroup :: class, 20) -> create();
    }
}
