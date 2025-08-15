<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<UserFactory> */
    use HasFactory;

    use HasProfilePhoto;
    use HasRoles;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
        'invited_by',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function invitee(): HasMany
    {
        return $this->hasMany(Invitation::class, 'invited_by');
    }

    public function invitedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'invited_by');
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function getTotalGamesPlayedAttribute()
    {
        return $this->gamePlayers()->count();
    }

    public function gamePlayers()
    {
        return $this->hasMany(GamePlayer::class);
    }

    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }

    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_players')
            ->withPivot(['position', 'points', 'is_winner', 'cup_photo_path'])
            ->withTimestamps();
    }

    public function getTotalPointsAttribute()
    {
        return $this->gamePlayers()->sum('points');
    }

    public function getTotalGamesWonAttribute()
    {
        return $this->gamePlayers()->where('is_winner', true)->count();
    }

    public function getTotalCupsWonAttribute()
    {
        return $this->gamePlayers()->where('position', 1)->count();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
