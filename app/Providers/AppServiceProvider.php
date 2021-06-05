<?php

namespace App\Providers;

use App\Service\Media\MediaLibraryUpload;
use Illuminate\Support\ServiceProvider;
use Support\Media\Contracts\Upload;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Upload::class, MediaLibraryUpload::class);
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
