<?php

namespace Tests\Feature;

use Domain\Content\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class PostTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function test_post_can_be_created_with_only_body()
    {
        $post = Post::factory()->make();
        $data = [
            'body' => $post->getAttribute('body'),
        ];

        $response = $this->post('/posts/create', $data);

        $response->assertStatus(201);
        $this->assertDatabaseCount($post->getTable(), 1);
        $this->assertDatabaseHas($post->getTable(), $data);
    }

    /** @test */
    public function test_post_can_be_created_with_full_attributes()
    {
        $post = Post::factory()->make();

        $response = $this->post('/posts/create', $post->toArray());

        $response->assertStatus(201);
        $this->assertDatabaseCount($post->getTable(), 1);
        $this->assertDatabaseHas($post->getTable(), $post->toArray());
    }

    /** @test */
    public function test_body_is_required_in_post_creation()
    {
        $post     = Post::factory()->make();
        $response = $this->post('/posts/create', \Arr::except($post->toArray(), 'body'));

        $response->assertSessionHasErrors('body');
    }
}
