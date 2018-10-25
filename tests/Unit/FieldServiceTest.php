<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

use App\Models\Fields\Field;
use App\Models\Fields\FieldService;

class FieldServiceTest extends TestCase
{
    public function test_retrieve_all_fields(){

        $response = $this->call('GET', '/fields');
        $this->assertEquals(200, $response->status());
        // dd($response);
    }

    public function test_retrieve_a_field(){

        $id = Field::find(1)->id;
        $response = $this->call('GET', '/fields/'.$id);
        $this->assertEquals(200, $response->status());
        // dd($response);

    }

    public function test_create_a_field() {
        $data = [
            'interest_id' => 1,
            'field_name' => 'create field',
        ];
        $field = factory(\App\Models\Fields\Field::class)->create();
        $response = $this->json('POST', '/fields/create',$data);
        $this->assertEquals(201, $response->status());
    }
    
    public function test_update_a_field(){
        $field = Field::find(1);
        $field -> field_name = 'update field';
        $field -> save();
        $response = $this->call('PUT', '/fields/1');
        $this->assertEquals(200, $response->status());
    }

    
    public function test_delete_a_field(){
        $id = Field::find(1)->id;
        $response = $this->call('DELETE', '/fields/'.$id);
        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing('fields', ['id' => $id]);
    }
}
