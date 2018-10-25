<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

use App\Models\Tasks\Task;
use App\Models\Tasks\TaskService;

class TaskServiceTest extends TestCase
{
    public function test_retrieve_all_tasks(){

        $response = $this->call('GET', '/tasks');
        $this->assertEquals(200, $response->status());
        // dd($response);
    }

    public function test_retrieve_a_task(){

        $id = Task::find(1)->id;
        $response = $this->call('GET', '/tasks/'.$id);
        $this->assertEquals(200, $response->status());
        // dd($response);
    }

    //InvalidArgumentException: Unable to locate factory with name [default] [App\Models\Tasks\Task].
	// public function test_create_a_task() {
    //     $data = [
    //         'title' => 'create task',
    //         'description' => 'create task description',
    //         'date_reminder' => '2018-09-06 11:47:49',
    //         'reminder_type' => 'create reminder-type',
    //         'date_completed' => '2018-09-06 11:47:49',
    //         'company_id' => 1,
    //         'employee_id' => 1,
    //         'assigned_to_id' => 1
    //     ];
    //     $task = factory(\App\Models\Tasks\Task::class)->create();
    //     $response = $this->json('POST', '/tasks/create',$data);
    //     $this->assertEquals(201, $response->status());
    // }
 
    public function test_update_a_task(){
        $task = Task::find(1);
        $task -> description = 'update task description';
        $task -> save();
        $response = $this->call('PUT', '/tasks/1');
        $this->assertEquals(200, $response->status());
    }


    public function test_delete_a_task(){
        $id = Task::find(1)->id;
        $response = $this->call('DELETE', '/tasks/'.$id);
        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing('tasks', ['id' => $id]);
    }
}
