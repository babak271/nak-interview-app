<?php

namespace App\Content\Http\Controller;

use App\Http\Controllers\Controller;
use App\Content\Http\Requests\StoreComment;
use App\Content\Http\Requests\UpdateComment;
use Domain\Content\Models\Comment;
use Domain\Content\Models\Post;
use Illuminate\Http\RedirectResponse;

class AddCommentToPostController extends Controller
{
    /**
     * Store a newly created comment in storage.
     *
     * @param StoreComment $request
     * @param Post $post
     * @return RedirectResponse
     */
    public function store(StoreComment $request, Post $post)
    {
        $request->persist($post);

        return back();
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
