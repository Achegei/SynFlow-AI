<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category_id',
        'user_id',
    ];
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    public function author()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function category()
{
    return $this->belongsTo(Category::class);
}

public function comments()
{
    return $this->hasMany(Comment::class);
}

public function likes()
{
    return $this->belongsToMany(User::class, 'likes')->withTimestamps();
}


}
