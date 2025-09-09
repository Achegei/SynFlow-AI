<?php

namespace App\Observers;

use App\Models\Like;
use App\Models\Activity;

class LikeObserver
{
    public function created(Like $like): void
    {
        Activity::log($like->user_id, 'like_given', 2);
    }
}
