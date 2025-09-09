<?php
use Illuminate\Foundation\Application;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use App\Observers\UserObserver;
use App\Observers\PostObserver;
use App\Observers\CommentObserver;
use App\Observers\LikeObserver;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        //
    })
    ->withExceptions(function ($exceptions) {
        //
    })
    ->create();

// Register your model observers **after** the app is created
User::observe(UserObserver::class);
Post::observe(PostObserver::class);
Comment::observe(CommentObserver::class);
Like::observe(LikeObserver::class);

return $app;
