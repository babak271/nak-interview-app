<?php

namespace Domain\Content\Traits;

use Domain\Content\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * Trait HasComments
 * @property Collection $comments
 */
trait HasComments
{
    /**
     * Give comment instance of the resource.
     *
     * @return MorphOne
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'model');
    }
}