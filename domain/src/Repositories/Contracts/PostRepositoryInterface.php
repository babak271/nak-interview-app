<?php

namespace Domain\Repositories\Contracts;

use Domain\BaseRepositoryInterface;
use Domain\Content\Enums\PostStatus;
use Domain\Content\Models\Post;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface extends BaseRepositoryInterface
{
    const ORDER_DESC = 'desc';
    const ORDER_ASC = 'asc';

    /**
     * Get all of posts.
     *
     * @param int|string $status
     * @param string|null $order
     * @param bool $include_comments
     * @return mixed
     */
    public function all(
        $status = PostStatus::ACTIVE | PostStatus::INACTIVE,
        ?string $order = self::ORDER_DESC | self::ORDER_ASC,
        $include_comments = true
    ): Collection;

    /**
     * Create a post.
     *
     * @param array $data
     * @return Post|null
     */
    public function create(array $data): ?Post;

    /**
     * Update a post.
     *
     * @param array $data
     * @param Post $post
     * @return Post|null
     */
    public function update(array $data, Post $post): ?Post;

    /**
     * Delete a post.
     *
     * @param Post $post
     * @return string|null title of the deleted Post.
     */
    public function delete(Post $post): ?string;
}
