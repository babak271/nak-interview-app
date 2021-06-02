<?php

namespace Domain\Repositories\Contracts;

use Domain\BaseRepositoryInterface;
use Domain\Content\Enums\CommentType;
use Domain\Content\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

interface CommentRepositoryInterface extends BaseRepositoryInterface
{
    const ORDER_DESC = 'desc';
    const ORDER_ASC = 'asc';
    const ORDER_MOST_RATED = 'most_rated';
    const ORDER_LEAST_RATED = 'least_rated';
    const STATUS_ALL = 'status_all';
    const STATUS_PENDING = 'status_pending';
    const STATUS_ACCEPTED = 'status_accepted';
    const STATUS_REJECTED = 'status_rejected';

    /**
     * Get all of comment.
     *
     * @param string $status
     * @param string|null $order
     * @return mixed
     */
    public function all(
        $status = self::STATUS_ALL | self::STATUS_ACCEPTED | self::STATUS_PENDING | self::STATUS_REJECTED,
        ?string $order = self::ORDER_DESC | self::ORDER_ASC | self::ORDER_MOST_RATED | self::ORDER_LEAST_RATED
    ): Collection;

    /**
     * Get all of comment.
     *
     * @param CommentType $type
     * @param string $status
     * @param string|null $order
     * @return mixed
     */
    public function allByType(
        CommentType $type,
        $status = self::STATUS_ALL | self::STATUS_ACCEPTED | self::STATUS_PENDING | self::STATUS_REJECTED,
        ?string $order = self::ORDER_DESC | self::ORDER_ASC | self::ORDER_MOST_RATED | self::ORDER_LEAST_RATED
    ): Collection;

    /**
     * Get all of comment of a resource.
     *
     * @param $resource
     * @param string $status
     * @param string|null $order
     * @param CommentType|null $type
     * @return mixed
     */
    public function allByResource(
        $resource,
        $status = self::STATUS_ALL | self::STATUS_ACCEPTED | self::STATUS_PENDING | self::STATUS_REJECTED,
        ?string $order = self::ORDER_DESC | self::ORDER_ASC | self::ORDER_MOST_RATED | self::ORDER_LEAST_RATED,
        ?CommentType $type = null
    ): Collection;

    /**
     * Get all of comment of a type of resource.
     *
     * @param $resource
     * @param string $status
     * @param string|null $order
     * @param CommentType|null $type
     * @return mixed
     */
    public function allByResourceClass(
        $resource,
        $status = self::STATUS_ALL | self::STATUS_ACCEPTED | self::STATUS_PENDING | self::STATUS_REJECTED,
        ?string $order = self::ORDER_DESC | self::ORDER_ASC | self::ORDER_MOST_RATED | self::ORDER_LEAST_RATED,
        ?CommentType $type = null
    ): Collection;

    /**
     * Get all of comment of a type of resource.
     *
     * @param $resource_namespace
     * @param CommentType|null $type
     * @param string $status
     * @param string|null $order
     * @return mixed
     */
    public function allByResourceNamespace(
        $resource_namespace,
        ?CommentType $type = null,
        $status = self::STATUS_ALL | self::STATUS_ACCEPTED | self::STATUS_PENDING | self::STATUS_REJECTED,
        ?string $order = self::ORDER_DESC | self::ORDER_ASC | self::ORDER_MOST_RATED | self::ORDER_LEAST_RATED
    ): Collection;

    /**
     * Create a comment.
     *
     * @param $resource
     * @param array $data
     * @return Comment|null
     */
    public function create($resource, array $data): ?Comment;

    /**
     * Update a comment.
     *
     * @param array $data
     * @param Comment $comment
     * @return Comment|null
     */
    public function update(array $data, Comment $comment): ?Comment;

    /**
     * Delete a comment.
     *
     * @param Comment $comment
     * @return string|null title of the deleted comment.
     */
    public function delete(Comment $comment): ?string;
}
