<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Game extends Model
{
    //    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'player_id',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function points()
    {
        return $this->hasMany(Points::class);
    }

    public function winner()
    {
        return $this->belongsTo(User::class, 'winner_id');
    }

    public function cupWinner()
    {
        return $this->belongsTo(User::class, 'cup_winner_id');
    }

    public function getFormattedDate()
    {
        return $this->date->format('j F Y');
        // Stel de locale in op Nederlands
        //        Carbon::setLocale('nl');

        // Veronderstel dat published_at een datum string is
        //        $publishedAt = Carbon::parse($this->date);

        // Gebruik translatedFormat om de maand in het Nederlands te krijgen
        //        return $publishedAt->translatedFormat('j F Y');

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
        ];
    }
}
