<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Clients\Company;
use App\Models\Clients\CompanyService;

use Phpml\Association\Apriori;

class CompanyServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->svc = app(CompanyService::class);
    }

    public function test_retrieve_all_companies(){

        $response = $this->call('GET', '/companies');
        $this->assertEquals(200, $response->status());
        
    }

    public function test_retrieve_a_company(){

        $id = Company::find(1)->id;
        $response = $this->call('GET', '/companies/'.$id);
        $this->assertEquals(200, $response->status());
        // dd($response);

    }

    //Failed asserting that 500 matches expected 201.
    public function test_create_a_company() {
        $data = [
            'name' => 'My Company',
            'address' => '565 Wunsch Road Apt. 832 Danton, KY 99289-3563',
            'email' => 'mycompany@mycompany.com',
            'telephone_no' => '66116622',
            'fax_no' => '66116622',
            'website' => 'mycompany.com',
            'no_employees' => '100',
            'industry' => 'IT',
            'lead_source' => 'abc',
            'client' => true,
            'description' => 'test create'
        ];

        $company = factory(\App\Models\Clients\Company::class)->create();
        $response = $this->json('POST', '/companies/create', $data);
        $this->assertEquals(201, $response->status());

        /* $data = [
            'user_id' => 1,
            'post_id' => 1,
            'comment_id' => 1
          ];
          $like = factory(\App\Models\Likes\Like::class)->create();
          $response = $this->json('POST', '/likes/create',$data);
          $this->assertEquals(201, $response->status()); */
    }
    
    // public function test_update_a_company(){

    //     $company = Company::find(21);
    //     $company -> name = 'Company 21';
    //     $company -> save();
    //     $response = $this->call('PUT', '/companies/21');
    //     $this->assertEquals(200, $response->status());

    // }

    // public function test_delete_a_company(){
    //     $id = Company::find(1)->id;
    //     $response = $this->call('DELETE', '/companies/'.$id);
    //     $this->assertEquals(200, $response->status());
    //     $this->assertDatabaseMissing('companies', ['id' => $id]);
    // }
    
    /** @test */
    // public function can_store_files()
    // {
    // }


}
