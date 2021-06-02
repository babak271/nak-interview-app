<?php

namespace App\Content\Http\Controller;

use App\Http\Controllers\Controller;
use App\Content\Http\Requests\StoreComment;
use App\Content\Http\Requests\UpdateComment;
use Domain\Content\Models\Comment;
use Domain\Content\Models\Post;

class AddCommentToPostController extends Controller
{
    /**
     * Store a newly created comment in storage.
     *
     * @param StoreComment $request
     * @param Post $post
     * @return Comment
     */
    public function store(StoreComment $request, Post $post)
    {
        return $request->persist($post);
    }

    /**
     * Update the specified comment in storage.
     *
     * @param UpdateComment $request
     * @param Comment $comment
     * @return Comment
     */
    public function update(UpdateComment $request, Comment $comment)
    {
        return $request->persist($comment);
    }
}
