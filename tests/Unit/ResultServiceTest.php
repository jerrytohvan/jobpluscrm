<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

use App\Models\Results\Result;
use App\Models\Results\ResultService;


class ResultServiceTest extends TestCase
{
    public function test_retrieve_all_results(){

        $response = $this->call('GET', '/results');
        $this->assertEquals(200, $response->status());
        // dd($response);
    }

    public function test_retrieve_a_result(){

        $id = Result::find(5)->id;
        $response = $this->call('GET', '/results/'.$id);
        $this->assertEquals(200, $response->status());
        // dd($response);

    }

    public function test_create_a_result() {
        $data = [
            'interest_id' => 100,
            'field_id' => 1,
            'candidate_id' => 2,
            'user_id' => 2,
            'project_group_id' => 2
        ];
        $result = factory(\App\Models\Results\Result::class)->create();
        $response = $this->json('POST', '/results/create',$data);
        $this->assertEquals(201, $response->status());
    }
    
    public function test_update_a_result(){
        $result = Result::find(1);
        $result -> field_id = '2';
        $result -> save();
        $response = $this->call('PUT', '/results/1');
        $this->assertEquals(200, $response->status());
    }

    public function test_delete_a_result(){
        $id = Result::find(1)->id;
        $response = $this->call('DELETE', '/results/'.$id);
        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing('results', ['id' => $id]);
    }
}
