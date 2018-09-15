<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

use App\Models\Resumes\Resume;
use App\Models\Resumes\ResumeService;

class ResumeServiceTest extends TestCase
{
    public function test_retrieve_all_resumes(){

        $response = $this->call('GET', '/resumes');
        $this->assertEquals(200, $response->status());
        // dd($response);
    }

    public function test_retrieve_a_resume(){

        $id = Resume::find(1)->id;
        $response = $this->call('GET', '/resumes/'.$id);
        $this->assertEquals(200, $response->status());
        // dd($response);

    }

    // InvalidArgumentException: Unable to locate factory with name [default] [App\Models\Resumes\Resume].
    public function test_create_a_resume() {
        $data = [
            'filename' => '/create_resume',
            'candidate_id' => 1,
            'extension' => '.extension'
        ];
        $resume = factory(\App\Models\Resumes\Resume::class)->create();
        $response = $this->json('POST', '/resumes/create',$data);
        $this->assertEquals(201, $response->status());
    }
 
    public function test_update_a_resume(){
        $resume = Resume::find(1);
        $resume -> filename = 'update resume';
        $resume -> save();
        $response = $this->call('PUT', '/resumes/1');
        $this->assertEquals(200, $response->status());
    }

    public function test_delete_a_resume(){
        $id = Resume::find(1)->id;
        $response = $this->call('DELETE', '/resumes/'.$id);
        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing('resumes', ['id' => $id]);
    }
}
