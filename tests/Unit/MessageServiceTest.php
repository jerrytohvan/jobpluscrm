<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

use App\Models\Messages\Message;
use App\Models\Messages\MessagesService;

class MessageServiceTest extends TestCase
{
    public function test_retrieve_all_messages(){

        $response = $this->call('GET', '/messages');
        $this->assertEquals(200, $response->status());
        // dd($response);
    }

    public function test_retrieve_an_interest(){

        $id = Message::find(5)->id;
        $response = $this->call('GET', '/messages/'.$id);
        $this->assertEquals(200, $response->status());
        // dd($response);

    }

    public function test_create_a_message() {
        $data = [
            'message_content' => 'create message',
            'sender_id' => 1,
            'receiver_id' => 2,
            'broadcast' => 'A'
        ];
        $message = factory(\App\Models\Messages\Message::class)->create();
        $response = $this->json('POST', '/messages/create',$data);
        $this->assertEquals(201, $response->status());
    }
 
    public function test_update_a_message(){
        $message = Message::find(1);
        $message -> message_content = 'update message';
        $message -> save();
        $response = $this->call('PUT', '/messages/1');
        $this->assertEquals(200, $response->status());
    }

    public function test_delete_a_message(){
        $id = Message::find(1)->id;
        $response = $this->call('DELETE', '/messages/'.$id);
        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing('messages', ['id' => $id]);
    }
}
