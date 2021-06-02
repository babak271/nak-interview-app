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

    /** @test */
    public function test_post_attributes_can_be_updated()
    {
        $post = Post::factory()->create();

        $new_body = \Str::random(200);
        $post->setAttribute('body', $new_body);

        $response = $this->patch("/posts/$post->id/update", $post->toArray());

        $response->assertStatus(200);
        $this->assertEquals(Post::find($post->id)->body, $new_body);
    }

    /** @test */
    public function test_body_is_required_for_updating_post()
    {
        $post     = Post::factory()->create();
        $response = $this->patch("/posts/$post->id/update", \Arr::except($post->toArray(), 'body'));

        $response->assertSessionHasErrors('body');
    }
}
