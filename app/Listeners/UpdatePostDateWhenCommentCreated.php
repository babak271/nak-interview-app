<?php

namespace App\Listeners;

use Domain\Content\Events\CommentCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdatePostDateWhenCommentCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param CommentCreated $event
     * @return void
     */
    public function handle($event)
    {
        $comment = $event->comment;
        $comment->commentable()
            ->update(['updated_at' => $comment->created_at]);
    }
}
