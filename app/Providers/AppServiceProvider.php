<?php

namespace App\Providers;

use App\Models\User;
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
        //        Model::automaticallyEagerLoadRelationships();
        //        Model::preventLazyLoading(! $this->app->isProduction());
        //        Model::preventSilentlyDiscardingAttributes(! $this->app->isProduction());
        //        Model::preventAccessingMissingAttributes(! $this->app->isProduction());

        Relation::enforceMorphMap([
            'user' => User::class,
        ]);
    }
}
