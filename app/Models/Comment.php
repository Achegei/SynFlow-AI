<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = ['user_id', 'post_id', 'content'];

    // Relationship to the author
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship back to the post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
