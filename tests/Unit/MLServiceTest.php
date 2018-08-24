<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use App\Models\MachineLearning\MLService;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use Phpml\Association\Apriori;

class MLServiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->svc = app(MLService::class);

        $samples = [['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta'], ['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta']];
        $labels  = [];

        $this->associator = new Apriori($support = 0.5, $confidence = 0.5);
        $this->associator->train($samples, $labels);
    }
    /** @test */
    public function test_predict_apriori_algorithm()
    {
        $predict = $this->associator->predict(['alpha','theta']);
        $this->assertCount(1, $predict);
        $this->assertEquals([['beta']], $predict);

        $predict = $this->associator->predict([['alpha','epsilon'],['beta','theta']]);
        $this->assertCount(2, $predict);
        $this->assertEquals([[['beta']],[['alpha']]], $predict);
    }

    /** @test */
    // public function can_add_sample_data_to_db()
    // {
    //     //localfiles only
    //     $data = $this->svc->setDataIntoDB(public_path()  . '/data_samples.csv');
    // }

    // /** @test */
    // public function can_parse_files_to_text()
    // {
    //     //localfiles only
    //     $data = $this->svc->matchResumeWithSampleData('resume.docx');
    //     $this->assertCount(3, $data);
    // }
}
