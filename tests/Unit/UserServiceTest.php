<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use App\Models\Users\User;
use App\Models\Clients\Company;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Users\UserService;

class UserServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->svc = app(UserService::class);
        $this->user = factory(User::class)->create();
        $this->faker = \Faker\Factory::create();
    }

    /** @test */
    public function can_attach_company()
    {
        $company =factory(Company::class)->create();
        $this->svc->attachUserWithCompany($this->user, $company);
        dd($this->user->companies);
    }
}
