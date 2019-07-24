<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadThreadsTest extends TestCase
{
    use RefreshDatabase;
    // public function setUp() 
    // {
    //     parent::setUp();

    //     $this->
    // }
    /** @test */
    public function a_user_can_view_all_threads()
    {
        $thread = factory('App\Thread')->create();
        $response = $this->get('/threads');

        $response->assertSee($thread->title);

        
    }
    /** @test */
    public function a_user_can_view_a_single_thread()
    {
        $thread = factory('App\Thread')->create();
        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($thread->title);
    }
    /** @test */
    public function a_user_can_read_reply_assiociated_with_thread()
    {
        $thread = factory('App\Thread')->create();

        $reply = factory('App\Reply')->create(['thread_id' => $thread->id]);
        
        $response = $this->get('/threads/' . $thread->id);
        $response->assertSee($reply->body);

    
    }
}
