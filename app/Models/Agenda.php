<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Agenda extends Model implements HasMedia
{
    use InteractsWithMedia;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'description',
        'date',
        'end_date',
        'image',
        'private',
    ];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the attendances for this agenda item.
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(AgendaAttendance::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getFormattedDateTime()
    {
        Carbon::setLocale('nl'); // Stel de taal in op Nederlands

        $start = $this->date?->translatedFormat('j F Y, H:i');
        $end = $this->end_date ? $this->end_date->translatedFormat('j F Y, H:i') : null;

        return $end ? ($start.' - '.$end) : $start;
    }

    public function getFormattedDate()
    {
        Carbon::setLocale('nl'); // Stel de taal in op Nederlands

        $start = $this->date?->translatedFormat('j F Y');
        $end = $this->end_date ? $this->end_date->translatedFormat('j F Y') : null;

        return $end ? ($start.' - '.$end) : $start;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('agendas');
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->width(368)
            ->height(232)
            ->nonQueued();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'date' => 'datetime',
            'end_date' => 'datetime',
            'private' => 'boolean',
        ];
    }
}
