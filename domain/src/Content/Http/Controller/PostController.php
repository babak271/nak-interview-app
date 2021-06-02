<?php

namespace Domain\Content\Http\Controller;

use Domain\Content\Http\Requests\StorePost;
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
}
