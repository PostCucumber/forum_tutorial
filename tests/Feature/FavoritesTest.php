<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    public function setup() : void
    {
        parent::setUp();
    }

    /** @test */
    public function guests_cannot_favorite_anything()
    {
        $this->post('/replies/1/favorites')
             ->assertRedirect('/login');
    }

    /** @test */
    public function an_authenticated_user_can_favorite_any_reply()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $reply = create('App\Reply');

        $this->post('/replies/' . $reply->id . '/favorites');

        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function an_authenticated_user_can_only_favorite_a_reply_once()
    {
        $this->withoutExceptionHandling();

        $this->signIn();

        $reply = create('App\Reply');

        try {
            $this->post('/replies/' . $reply->id . '/favorites');
            $this->post('/replies/' . $reply->id . '/favorites');
        } catch (\Exception $e) {
            $this->fail('Unique constraints in the database schema prevent favoriting the same item more than once.');
        }

        //dd(\App\Favorite::all()->toArray());

        $this->assertCount(1, $reply->favorites);       
    }

}
