<?php

namespace App\Providers;

use App\Entity\Blog\Post;
use App\Observers\PostObserver;
use App\UseCases\Blade\DirectiveFactory;
use App\UseCases\Blade\ShortcodeFactory;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        (new DirectiveFactory())->register();

        (new ShortcodeFactory())->register();

        Post::observe(PostObserver::class);

        // Localization Carbon
        Carbon::setLocale(config('app.locale'));
    }
}
