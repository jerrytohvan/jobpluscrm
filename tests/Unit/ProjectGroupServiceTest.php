<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

use App\Models\ProjectGroups\ProjectGroup;
use App\Models\ProjectGroups\ProjectGroupService;

class ProjectGroupServiceTest extends TestCase
{
    public function test_retrieve_all_projectGroups(){

        $response = $this->call('GET', '/projectGroups');
        $this->assertEquals(200, $response->status());
        
    }
    
    public function test_retrieve_a_projectGroup(){

        $id = projectGroup::find(5)->id;
        $response = $this->call('GET', '/projectGroups/'.$id);
        $this->assertEquals(200, $response->status());
        // dd($response);
    }

    public function test_create_a_projectgroup() {
        $data = [
            'group_name' => 'My Test Group 2',
            'admin_id' => 1,
            'user_id' => 1,
            'created_at' => '2018-01-01 11:55:00',
            'updated_at' => '2018-01-01 11:55:00'
        ];
        $projectgroup = factory(\App\Models\ProjectGroups\ProjectGroup::class)->create();
        $response = $this->json('POST', '/projectGroups/create',$data);
        $this->assertEquals(201, $response->status());
    }
    
    public function test_update_a_projectgroup(){

        $projectgroup = ProjectGroup::find(21);
        $projectgroup -> group_name = 'My Group 1';
        $projectgroup -> save();
        $response = $this->call('PUT', '/projectGroups/21');
        $this->assertEquals(200, $response->status());

    }

    public function test_delete_a_projectGroup(){
        $id = projectGroup::find(1)->id;
        $response = $this->call('DELETE', '/projectGroups/'.$id);
        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing('project_groups', ['id' => $id]);
    }
}
