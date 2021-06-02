<?php

namespace Domain\Repositories;

use Domain\BaseRepository;
use Domain\Content\Enums\CommentStatus;
use Domain\Content\Enums\CommentType;
use Domain\Content\Models\Comment;
use Domain\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    /**
     * @return Builder
     */
    protected function getQuery()
    {
        return Comment::query();
    }

    /**
     * @inheritDoc
     */
    public function all($status = self::STATUS_ALL,
                        ?string $order = self::ORDER_DESC): Collection
    {
        return $this->getAllHandler($status, $order)->get();
    }

    /**
     * @inheritDoc
     */
    public function allByType(CommentType $type,
                              $status = self::STATUS_ALL,
                              ?string $order = self::ORDER_DESC): Collection
    {
        return $this->getAllHandler($status, $order)
            ->where('type', $type->value)
            ->get();
    }

    protected function getAllHandler($status = self::STATUS_ALL,
                                     ?string $order = self::ORDER_DESC): Builder
    {
        $query = Comment::query();

        $status = $this->getCommentStatus($status);
        if ($status) $query->where('status', $status);

        $query = $this->getCommentOrder($query, $order);

        return $query;
    }

    protected function getCommentOrder(Builder $query, $order)
    {
        switch ($order) {
            case self::ORDER_ASC:
                $query->oldest();
                break;
            case self::ORDER_MOST_RATED:
                $query->oldest();
                break;
            case self::ORDER_LEAST_RATED:
                $query->oldest();
                break;
            default:
                $query->latest();
                break;
        }

        return $query;
    }

    protected function getCommentStatus($status)
    {
        if ($status == self::STATUS_ALL) return null;
        switch ($status) {
            case self::STATUS_PENDING:
                $status = CommentStatus::PENDING;
                break;
            case self::STATUS_REJECTED:
                $status = CommentStatus::REJECTED;
                break;
            default:
                $status = CommentStatus::ACCEPTED;
                break;
        }

        return $status;
    }

    /**
     * @inheritDoc
     */
    public function allByResource($resource,
                                  $status = self::STATUS_ALL,
                                  ?string $order = self::ORDER_DESC,
                                  ?CommentType $type = null): Collection
    {
        $query = $this->getAllHandler($status, $order);
        if ($type) $query->where('type', $type->value);
        return $query->where('model_type', get_class($resource))
            ->where('model_id', $resource->id)
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function allByResourceClass($resource,
                                       $status = self::STATUS_ALL,
                                       ?string $order = self::ORDER_DESC,
                                       ?CommentType $type = null): Collection
    {
        $query = $this->getAllHandler($status, $order);
        if ($type) $query->where('type', $type->value);
        return $query->where('model_type', get_class($resource))
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function allByResourceNamespace($resource_namespace,
                                           ?CommentType $type = null,
                                           $status = self::STATUS_ALL,
                                           ?string $order = self::ORDER_DESC): Collection
    {
        $query = $this->getAllHandler($status, $order);
        if ($type) $query->where('type', $type->value);
        return $query->where('model_type', $resource_namespace)
            ->get();
    }

    /**
     * @inheritDoc
     */
    public function create($resource, array $data): Comment
    {
        $data['user_id']    = \Auth::check() ? \Auth::id() : null;
        $data['ip_address'] = request()->ip();
        $data['model_id']   = $resource->id;
        $data['model_type'] = get_class($resource);

        $comment = new Comment();

        $comment->fill($data);

        $comment->save();

        return $comment;
    }

    /**
     * @inheritDoc
     */
    public function update(array $data, Comment $comment): ?Comment
    {
        $comment->update($data);

        return $comment;
    }

    /**
     * @inheritDoc
     */
    public function delete(Comment $comment): ?string
    {
        $comment_title = $comment->title;

        $comment->delete();

        return $comment_title;
    }
}
