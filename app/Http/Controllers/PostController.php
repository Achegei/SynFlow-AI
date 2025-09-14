<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Activity;
use App\Models\Category;
use Illuminate\Http\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
       public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'category_id' => 'required|integer|exists:categories,id',
    ]);

    $post = Post::create([
        'title' => $request->title,
        'content' => $request->content,
        'category_id' => $request->category_id,
        'user_id' => auth()->id(), // ✅ Add this
    ]);

    return response()->json(['success' => true, 'post' => $post]);
}

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
   public function like(Post $post)
        {
            $user = auth()->user();

            // Toggle like
            $liked = $post->likes()->toggle($user->id);

            return response()->json([
                'success' => true,
                'likes_count' => $post->likes()->count()
            ]);
        }


public function comment(Request $request, Post $post)
{
    $request->validate([
        'content' => 'required|string|max:500',
    ]);

    $comment = $post->comments()->create([
        'user_id' => auth()->id(),
        'content' => $request->content,
    ]);

    return response()->json([
        'success' => true,
        'comment' => [
            'id' => $comment->id,
            'user_name' => auth()->user()->name,
            'user_avatar' => auth()->user()->profile_photo_url,
            'content' => $comment->content,
            'created_at' => $comment->created_at->diffForHumans(),
        ],
        'comments_count' => $post->comments()->count()
    ]);
}

}
