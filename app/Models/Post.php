<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use Sluggable;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'body',
        'featured',
        'published_at'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'like_post')->withTimestamps();
    }

    public function getFormattedDate()
    {
        return $this->published_at->format('F jS Y');
    }

    public function shortBody($words = 50): string
    {
        return Str::words(strip_tags($this->body), $words);
    }

    public function getReadingTime()
    {
        $mins = round(str_word_count($this->body) / 250);

        return ($mins < 1) ? 1 : $mins;
    }
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeFeatured($query)
    {
        $query->where('featured', true);
    }

    public function scopeSearch($query, string $search = '') {
        $query->where('title', 'like', "%{$search}%")
            ->orWhere('body', 'like', "%{$search}%");
    }

    public function scopeWithCategory($query, string $category)
    {
        $query->whereHas('categories', function ($query) use ($category) {
            $query->where('slug', $category);
        });
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->width(368)
            ->height(232);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getImage()
    {
        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        return '/storage/' . $this->image;
    }
}


