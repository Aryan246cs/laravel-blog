<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'body', 'user_id', 'visibility', 'category_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}