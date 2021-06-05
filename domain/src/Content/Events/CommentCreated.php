<?php

namespace Domain\Content\Events;

use Domain\Content\Models\Comment;
use Illuminate\Queue\SerializesModels;

class CommentCreated
{
    use SerializesModels;

    /**
     * @var Comment
     */
    public $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
}