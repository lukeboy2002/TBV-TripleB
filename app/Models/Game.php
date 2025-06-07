<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{
    protected $fillable = [
        'date',
        'status',
        'completed_at',
    ];

    protected $casts = [
        'date' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function cupWinner()
    {
        return $this->gamePlayers()->where('position', 1)->first()?->user;
    }

    public function gamePlayers(): HasMany
    {
        return $this->hasMany(GamePlayer::class);
    }
}
