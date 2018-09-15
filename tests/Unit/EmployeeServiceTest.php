<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use App\Models\Employees\Employee;
use App\Models\Employees\employeeService;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

class EmployeeServiceTest extends TestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->svc = app(employeeService::class);
        $this->employee = factory(Employee::class)->create();
        // dd($this->user);
        $this->faker = \Faker\Factory::create();
    }
    
   
    public function test_retrieve_all_employees(){

        $response = $this->call('GET', '/employees');
        $this->assertEquals(200, $response->status());
        
    }
    
    public function test_retrieve_an_employee(){

        $id = Employee::find(10)->id;
        $response = $this->call('GET', '/employees/'.$id);
        $this->assertEquals(200, $response->status());
        // dd($response);
    }

    public function test_create_an_employee() {
        $data = [
            'name' => 'Baejin',
            'title' => 'Senior',
            'handphone' => 99119911,
            'email' => 'woojin@jpp.com',
            'telephone' => 6611661,
            'company_id' => 1,
        ];
        $employee = factory(\App\Models\Employees\Employee::class)->create();
        $response = $this->json('POST', '/employees/create',$data);
        $this->assertEquals(201, $response->status());
    }
    
    public function test_update_an_employee(){
        $employee = Employee::find(41);
        $employee -> name = 'Eric';
        $employee -> save();
        $response = $this->call('PUT', '/employees/41');
        $this->assertEquals(200, $response->status());
    }

    public function test_delete_an_employee(){
        $id = Employee::find(1)->id;
        $response = $this->call('DELETE', '/employees/'.$id);
        $this->assertEquals(200, $response->status());
        $this->assertDatabaseMissing('employees', ['id' => $id]);
    }

}
