<?php

namespace App\Providers;

use App\View\Components\Article;
use App\View\Components\CommentInput;
use App\View\Components\CommentSingle;
use App\View\Components\TextareaInput;
use App\View\Components\TextInput;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        Blade::component(Article::class, 'components.app.article');
        Blade::component(CommentInput::class, 'components.app.comment-input');
        Blade::component(CommentSingle::class, 'components.app.comment-single');
        Blade::component(TextareaInput::class, 'components.app.textarea-input');
        Blade::component(TextInput::class, 'components.app.text-input');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot()
    {
        //
    }
}
