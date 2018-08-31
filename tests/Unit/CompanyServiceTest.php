<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Clients\CompanyService;

use Phpml\Association\Apriori;

class CompanyServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->svc = app(CompanyService::class);
    }
    /** @test */
    public function can_store_files()
    {
    }
}
