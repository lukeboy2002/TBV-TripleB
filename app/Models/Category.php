<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use Sluggable;
    protected $fillable = [
        'title',
        'slug',
        'color',
    ];

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class);
    }

//    public function publishedPosts(): BelongsToMany
//    {
//        return $this->belongsToMany(Post::class)
//            ->where('active', '=', 1)
//            ->whereDate('published_at', '<', Carbon::now());
//    }

    public function scopeSearch($query, $value) {
        $query->where('title', 'like', "%{$value}%")
            ->orWhere('slug', 'like', "%{$value}%");
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
