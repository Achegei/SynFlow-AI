<?php

namespace App\Observers;

use App\Models\Comment;
use App\Models\Activity;

class CommentObserver
{
    public function created(Comment $comment): void
    {
        Activity::log($comment->user_id, 'comment_added', 5);
    }
}
