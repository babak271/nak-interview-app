<?php

namespace Tests\Feature;

use Domain\Content\Models\Comment;
use Domain\Content\Models\Post;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AddCommentToPostTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function test_comment_can_be_added_to_post()
    {
        $post    = Post::factory()->create();
        $comment = Comment::factory()->make();

        $response = $this->post("/posts/$post->id/comments/create", $comment->toArray());

        $response->assertStatus(201);
        $this->assertDatabaseCount($comment->getTable(), 1);
    }

    /** @test */
    public function test_comment_can_be_updated()
    {
        $comment = Comment::factory()->for(
            Post::factory(), 'commentable'
        )->create();

        $new_body = \Str::random(200);
        $comment->setAttribute('body', $new_body);

        $response = $this->patch("/posts/comments/$comment->id/update", $comment->toArray());

        $response->assertStatus(200);
        $this->assertEquals(Comment::find($comment->id)->body, $new_body);
    }
}
