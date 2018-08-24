<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use App\Models\Users\User;
use App\Models\SocialWall\SocialWallService;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SocialWallTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->svc = app(SocialWallService::class);
        $this->user = factory(User::class)->create();
        // dd($this->user);
        $this->faker = \Faker\Factory::create();
    }

    /** @test */
    public function can_post_social_wall()
    {
        $sentence =$this->faker->sentence;
        $post = $this->svc->addPost($this->user, ['body' => $sentence]);
        $this->assertEquals($sentence, $post->content);
    }
}
