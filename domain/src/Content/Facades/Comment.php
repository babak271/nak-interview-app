<?php

namespace Domain\Content\Facades;

use Domain\Content\Enums\CommentType;
use Domain\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Collection all($status = CommentRepositoryInterface::STATUS_ALL | CommentRepositoryInterface::STATUS_ACCEPTED | CommentRepositoryInterface::STATUS_PENDING | CommentRepositoryInterface::STATUS_REJECTED,?string $order = CommentRepositoryInterface::ORDER_DESC | CommentRepositoryInterface::ORDER_ASC | CommentRepositoryInterface::ORDER_MOST_RATED | CommentRepositoryInterface::ORDER_LEAST_RATED)
 * @method static Collection allByType(CommentType $type,$status = CommentRepositoryInterface::STATUS_ALL | CommentRepositoryInterface::STATUS_ACCEPTED | CommentRepositoryInterface::STATUS_PENDING | CommentRepositoryInterface::STATUS_REJECTED,?string $order = CommentRepositoryInterface::ORDER_DESC | CommentRepositoryInterface::ORDER_ASC | CommentRepositoryInterface::ORDER_MOST_RATED | CommentRepositoryInterface::ORDER_LEAST_RATED)
 * @method static Collection allByResource($resource,$status = CommentRepositoryInterface::STATUS_ALL | CommentRepositoryInterface::STATUS_ACCEPTED | CommentRepositoryInterface::STATUS_PENDING | CommentRepositoryInterface::STATUS_REJECTED,?string $order = CommentRepositoryInterface::ORDER_DESC | CommentRepositoryInterface::ORDER_ASC | CommentRepositoryInterface::ORDER_MOST_RATED | CommentRepositoryInterface::ORDER_LEAST_RATED,?CommentType $type = null)
 * @method static Collection allByResourceClass($resource,$status = CommentRepositoryInterface::STATUS_ALL | CommentRepositoryInterface::STATUS_ACCEPTED | CommentRepositoryInterface::STATUS_PENDING | CommentRepositoryInterface::STATUS_REJECTED,?string $order = CommentRepositoryInterface::ORDER_DESC | CommentRepositoryInterface::ORDER_ASC | CommentRepositoryInterface::ORDER_MOST_RATED | CommentRepositoryInterface::ORDER_LEAST_RATED,?CommentType $type = null)
 * @method static Collection allByResourceNamespace($resource_namespace,?CommentType $type = null,$status = CommentRepositoryInterface::STATUS_ALL | CommentRepositoryInterface::STATUS_ACCEPTED | CommentRepositoryInterface::STATUS_PENDING | CommentRepositoryInterface::STATUS_REJECTED,?string $order = CommentRepositoryInterface::ORDER_DESC | CommentRepositoryInterface::ORDER_ASC | CommentRepositoryInterface::ORDER_MOST_RATED | CommentRepositoryInterface::ORDER_LEAST_RATED)
 * @method static \Domain\Content\Models\Comment create($resource, array $data)
 * @method static \Domain\Content\Models\Comment update(array $data, \Domain\Content\Models\Comment $comment)
 * @method static string delete(\Domain\Content\Models\Comment $comment)
 */
class Comment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'comment';
    }
}