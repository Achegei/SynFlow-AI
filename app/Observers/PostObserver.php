<?php

namespace App\Observers;

use App\Models\Post;
use App\Models\Activity;

class PostObserver
{
    public function created(Post $post): void
    {
        Activity::log($post->user_id, 'post_created', 10);
    }
}
