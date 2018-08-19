<?php

namespace Tests\Unit;

use Tests\TestCase;
use Faker\Factory;
use App\Models\Likes\Like;
use App\Models\Likes\LikeService;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LikeServiceTest extends TestCase
{
    public function setUp(){
        parent::setUp();
        $this->postId = 333;
        $this->svc = app(LikeService::class);
        $this->like = factory(Like::class)->create( ['post_id' =>   $this->postId  ]);
        $this->faker = \Faker\Factory::create();

      }
      /** @test */
     public function can_retrieve_like_records()
     {
       $this->assertNotNull($this->like);
       $this->assertEquals($this->like->post_id, $this->postId);
     }
      /** @test */
     public function can_store_like_record()
     {
       $user_id = 999;
       $like = $this->svc->storeLike([
         'user_id' => $user_id,
         'post_id' => $this->postId,
         'comment_id' => 222
       ]);
       $this->assertNotNull($like);
       $this->assertEquals($user_id, $like->user_id);
     }
     /** @test */
    public function can_update_like_record()
    {
      $updatePost = 777;
      $like = $this->svc->updateLike($this->like, ['post_id'=>$updatePost]);
      $this->assertEquals($updatePost, $like->post_id);
    }

    /** @test */
   public function can_delete_a_record()
   {
    $like = $this->svc->destroyLike($this->like);
    $this->assertEquals(204,$like);
   }

}
