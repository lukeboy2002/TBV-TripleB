<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Support\ImageCompressor;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Spatie\MediaLibrary\MediaCollections\Events\MediaHasBeenAddedEvent;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::automaticallyEagerLoadRelationships();

        Model::preventLazyLoading(! $this->app->isProduction());
        Model::preventSilentlyDiscardingAttributes(! $this->app->isProduction());
        Model::preventAccessingMissingAttributes(! $this->app->isProduction());

        Relation::morphMap([
            'post' => Post::class,
            'comment' => Comment::class,
            'user' => User::class,
            // 'category' is not required here since Category is not used in a polymorphic relation
            // but keeping it is harmless. Remove or keep based on preference.
            // 'category' => Category::class,
            //            'tag' => Tag::class,
        ]);

        // Compress originals for all newly added Spatie Media Library items
        /** @var Dispatcher $events */
        $events = $this->app->make(Dispatcher::class);
        $events->listen(MediaHasBeenAddedEvent::class, function (MediaHasBeenAddedEvent $event): void {
            try {
                $path = $event->media->getPath();
                if ($path && is_file($path)) {
                    ImageCompressor::compressToMaxBytes($path, 512_000);
                }
            } catch (Throwable $e) {
                // silently ignore
            }
        });
    }
}
