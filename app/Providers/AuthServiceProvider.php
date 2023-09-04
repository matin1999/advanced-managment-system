<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use App\Policies\ArticlePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Article::class => ArticlePolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('isAdmin', function ($user) {
            return $user->role->name == 'admin';
        });
        Gate::define('isUser', function ($user) {
            return $user->role->name == 'user';
        });

    }
}
