<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

use App\Models\Interests\Interest;
use App\Models\Interests\InterestService;

class InterestServiceTest extends TestCase
{
    public function test_retrieve_all_interests(){

        $response = $this->call('GET', '/interests');
        $this->assertEquals(200, $response->status());
        // dd($response);
    }

    public function test_retrieve_an_interest(){

        $id = Interest::find(5)->id;
        $response = $this->call('GET', '/interests/'.$id);
        $this->assertEquals(200, $response->status());
        // dd($response);

    }

    public function test_create_an_interest() {
        $data = [
            'interest_name' => 'interesting name'
        ];
        $interest = factory(\App\Models\Interests\Interest::class)->create();
        $response = $this->json('POST', '/interests/create',$data);
        $this->assertEquals(201, $response->status());
    }
 
    public function test_update_an_interest(){
        $interest = Interest::find(1);
        $interest -> interest_name = 'not interesting name';
        $interest -> save();
        $response = $this->call('PUT', '/interests/1');
        $this->assertEquals(200, $response->status());
    }

    public function test_delete_an_interests(){
        $id = Interest::find(1)->id;
        $response = $this->call('DELETE', '/interests/'.$id);
        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing('interests', ['id' => $id]);
    }
}
