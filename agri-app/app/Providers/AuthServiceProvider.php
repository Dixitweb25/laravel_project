<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Blog;
use App\Policies\BlogPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Policy mapping
     */
    protected $policies = [
        Blog::class => BlogPolicy::class,
    ];

    // public function boot(): void
    // {
    //     $this->registerPolicies();
    // }
}
