<?php

namespace App\Providers;

use App\Models\Agenda;
use App\Models\Album;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::automaticallyEagerLoadRelationships();

        Model::preventLazyLoading(! $this->app->isProduction());
        Model::preventSilentlyDiscardingAttributes(! $this->app->isProduction());
        Model::preventAccessingMissingAttributes(! $this->app->isProduction());

        Relation::enforceMorphMap([
            'post' => Post::class,
            'comment' => Comment::class,
            'user' => User::class,
            'album' => Album::class,
            'agenda' => Agenda::class,
        ]);
    }
}
