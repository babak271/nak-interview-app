<?php

namespace Domain\Providers;

use Domain\Repositories\CommentRepository;
use Domain\Repositories\Contracts\CommentRepositoryInterface;
use Domain\Repositories\Contracts\PostRepositoryInterface;
use Domain\Repositories\PostRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PostRepositoryInterface::class, PostRepository::class);
        $this->app->singleton(CommentRepositoryInterface::class, CommentRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
