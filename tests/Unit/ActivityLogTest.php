<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use App\Models\Users\User;
use App\Models\SocialWall\SocialWallService;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Activitylog\Models\Activity;
use App\Models\Posts\Post;

class ActivityLogTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->svc = app(SocialWallService::class);
        $this->user = factory(User::class)->create();
        $this->faker = \Faker\Factory::create();
    }

    /** @test */
    public function can_log_test()
    {
        $sentence =$this->faker->sentence;
        activity()->log($sentence);
        $lastLoggedActivity = Activity::all()->last();
        $this->assertEquals($sentence, $lastLoggedActivity->description);
    }
    /** @test */
    public function can_log_user()
    {
        $name =$this->faker->name;
        $email =$this->faker->email;
        $user = User::create([
        'name' => $name,
        'email' => $email,
        'password' => bcrypt($name),
        'birth_date' => $this->faker->dateTimeThisCentury->format('Y-m-d'),
        'profile_pic' => 'test',
        'admin' => false,
            ]);

        $lastLoggedActivity = Activity::all()->last();
        $this->assertEquals($user->name, $lastLoggedActivity->getExtraProperty('attributes')['name']);
    }
    /** @test */
    public function can_log_wall_post_by_user()
    {
        $sentence = $this->faker->sentence;
        $post = $this->svc->addPost($this->user, [
          'body' => $sentence
        ]);
        $accActivity = Activity::all()->last();
        // dd($lastLoggedActivity);
        activity()->causedBy($this->user)->performedOn($post);
        $lastActivity = Activity::all()->last();

        $this->assertEquals($sentence, Post::find($lastActivity->getExtraProperty('attributes')['commentable_id'])->content);
    }
}
