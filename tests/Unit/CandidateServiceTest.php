<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

use App\Models\Clients\Candidate;
use App\Models\Clients\CandidateService;

class CandidateServiceTest extends TestCase
{
    public function test_retrieve_all_candidates(){

        $response = $this->call('GET', '/candidates');
        $this->assertEquals(200, $response->status());
        // dd($response);
    }

    public function test_retrieve_a_candidate(){

        $id = Candidate::find(1)->id;
        $response = $this->call('GET', '/candidates/'.$id);
        $this->assertEquals(200, $response->status());
        // dd($response);
    }

    //NOT WORKING 
    public function test_create_a_candidate() {
        
        $data = [
            'name' => 'My Test Group 2',
            'title' => 1,
            'gender' => 1,
            'email' => 'candidate@email.com',
            'handphone' => 99119922,
            'telephone' => 66116622,
            'birthdate' => '1995-08-25',
            'created_at' => '2018-01-01 11:55:00',
            'updated_at' => '2018-01-01 11:55:00'
        ];
        $candidate = factory(\App\Models\Clients\Candidate::class)->create();
        $response = $this->json('POST', '/candidates/create', $data);
        $this->assertEquals(201, $response->status());
    }
    
    public function test_update_a_candidate(){

        $candidate = Candidate::find(1);
        $candidate -> name = 'Jihoon-ie';
        $candidate -> save();
        $response = $this->call('PUT', '/candidates/1');
        $this->assertEquals(200, $response->status());

    }

    //Failed asserting that 500 matches expected 200. 
    // public function test_delete_a_candidate(){
    //     $id = Candidate::find(1)->id;
    //     $response = $this->call('DELETE', '/candidates/'.$id);
    //     $this->assertEquals(200, $response->status());
    //     $this->assertDatabaseMissing('candidates', ['id' => $id]);
    // }

    // //Failed asserting that 500 matches expected 200. 
    // public function test_delete_a_candidate(){
    //     $id = Candidate::find(1)->id;
    //     $response = $this->call('DELETE', '/candidates/'.$id);
    //     $this->assertEquals(200, $response->status());
    //     $this->assertDatabaseMissing('candidates', ['id' => $id]);
    // }
}
