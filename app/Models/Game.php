<?php

namespace App\Models;

use Carbon\Carbon;
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
        return $this->gamePlayers()->where('position', 1)->first()?->user;
    }

    public function gamePlayers(): HasMany
    {
        return $this->hasMany(GamePlayer::class);
    }

    //    TODO SET DATE IN BLADE
    public function getFormattedDate()
    {
        Carbon::setLocale('nl'); // Stel de taal in op Nederlands

        return $this->created_at->translatedFormat('j F Y');

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
