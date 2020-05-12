<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;
    
    public function setup() : void
    {
        parent::setUp();

        $this->user = factory('App\User')->create();
        $this->thread = factory('App\Thread')->create();
        $this->reply = factory('App\Reply')->make();
    }

    /** @test */
    public function unauthenticated_users_may_not_add_replies()
    {
        $this->post($this->thread->path() . '/replies', [])
             ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_may_participate_in_forum_threads()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $this->post($this->thread->path() . '/replies', $this->reply->toArray());

        $this->get($this->thread->path())
             ->assertSee($this->reply->body);
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        //$this->withoutExceptionHandling();
        $this->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
             ->assertSee('Illuminate\Database\QueryException');        
    }
}
