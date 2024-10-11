<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Points extends Model
{
    //    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'game_id',
        'user_id',
        'points',
        'won_match',
        'won_cup',
    ];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
