<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'status',
        'completed_at',
    ];

    public function cupWinner()
    {
        // Ensure the user relation is eager-loaded to avoid lazy-loading issues
        return $this->gamePlayers()
            ->where('position', 1)
            ->with('user')
            ->first()?->user;
    }

    public function gamePlayers(): HasMany
    {
        return $this->hasMany(GamePlayer::class);
    }

    public function getFormattedDate()
    {
        return $this->date->format('d F Y');
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
            'completed_at' => 'datetime',
        ];
    }
}
