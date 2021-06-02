<?php

namespace Domain\Content\Http\Controller;

use Domain\Content\Http\Requests\StorePost;
use Domain\Content\Http\Requests\UpdatePost;
use Domain\Content\Models\Post;
use Domain\Controller;

class PostController extends Controller
{
    /**
     * Store a newly created post in storage.
     *
     * @param StorePost $request
     * @return Post
     */
    public function store(StorePost $request)
    {
        return $request->persist();
    }

    /**
     * Update the specified post in storage.
     *
     * @param UpdatePost $request
     * @param Post $post
     * @return Post
     */
    public function update(UpdatePost $request, Post $post)
    {
        return $request->persist($post);
    }
}
