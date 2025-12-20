<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Database\Factories\EventFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Tags\HasTags;

class Event extends Model
{
    /** @use HasFactory<EventFactory> */
    use HasFactory;

    use HasTags;
    use Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'body',
        'date',
        'end_date',
        'image_path',
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
        return $this->hasMany(EventAttendance::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ],
        ];
    }

    public function getFormattedDate()
    {
        //        Carbon::setLocale('nl'); // Stel de taal in op Nederlands

        $start = $this->date?->translatedFormat('j F Y');
        $end = $this->end_date ? $this->end_date->translatedFormat('j F Y') : null;

        return $end ? ($start.' - '.$end) : $start;
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
