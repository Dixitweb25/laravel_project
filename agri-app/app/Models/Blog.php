<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['user_id', 'category_id', 'title', 'description', 'image', 'post_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(BlogCategory::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function isLikedBy($user)
    {
        if (!$user) {
            return false;
        }
        return $this->likes()->where('user_id', $user->id)->exists();
    }

}
