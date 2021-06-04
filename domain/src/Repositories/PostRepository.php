<?php

namespace Domain\Repositories;

use Domain\BaseRepository;
use Domain\Content\Enums\PostStatus;
use Domain\Content\Models\Post;
use Domain\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * @return Builder
     */
    protected function getQuery()
    {
        return Post::query();
    }

    /**
     * @inheritDoc
     */
    public function all($status = PostStatus::ACTIVE | PostStatus::INACTIVE,
                        ?string $order = self::ORDER_DESC | self::ORDER_ASC,
                        $include_comments = true): Collection
    {
        $query = $this->getAllHandler($status, $order);
        $include_comments && $query->with('comments');

        return $query->get();
    }

    protected function getAllHandler($status, $order): Builder
    {
        $query = $this->getQuery();

        if ($status) $query->where('status', $status);

        $order && $query = $this->getPostOrder($query, $order);

        return $query;
    }

    protected function getPostOrder(Builder $query, $order)
    {
        switch ($order) {
            case self::ORDER_ASC:
                $query->oldest();
                break;
            default:
                $query->latest();
                break;
        }

        return $query;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Post
    {
        $post = (new Post())
            ->fill($data);

        $post->save();

        return $post;
    }

    /**
     * @inheritDoc
     */
    public function update(array $data, Post $post): ?Post
    {
        $post->update($data);

        return $post;
    }

    /**
     * @inheritDoc
     */
    public function delete(Post $post): ?string
    {
        $post_title = $post->title;

        $post->delete();

        return $post_title;
    }
}
