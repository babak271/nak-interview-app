<?php

namespace App\Content\Http\Controller;

use App\Content\Http\Requests\StorePost;
use App\Content\Http\Requests\UpdatePost;
use Domain\Content\Enums\PostStatus;
use Domain\Content\Models\Post;
use Domain\Controller;
use Domain\Repositories\Contracts\CommentRepositoryInterface;
use Domain\Repositories\Contracts\PostRepositoryInterface;

class PostController extends Controller
{
    /**
     * @var PostRepositoryInterface
     */
    public $postRepository;
    /**
     * @var CommentRepositoryInterface
     */
    public $commentRepository;

    public function __construct(PostRepositoryInterface $postRepository, CommentRepositoryInterface $commentRepository)
    {
        $this->postRepository    = $postRepository;
        $this->commentRepository = $commentRepository;
    }

    public function index()
    {
        $articles = $this->postRepository
            ->all(PostStatus::ACTIVE, PostRepositoryInterface::ORDER_DESC);

        return view('front.index', compact('articles'));
    }

    /**
     * Store a newly created post in storage.
     *
     * @param StorePost $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePost $request)
    {
        $request->persist();

        return back();
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

    public function destroy(Post $post)
    {

    }
}
