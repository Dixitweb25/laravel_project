<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Blog;

class BlogPolicy
{
    public function update(User $user, Blog $blog): bool
    {
        return $user->id === $blog->user_id;
    }

    public function delete(User $user, Blog $blog): bool
    {
        return $user->id === $blog->user_id;
    }
}
