<?php

namespace App\Models;

use Database\Factories\InvitationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    /** @use HasFactory<InvitationFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'invited_by',
        'invited_date',
        'invitation_token',
        'registered_at',
    ];

    public function invitedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'invited_by');
    }

    public function generateInvitationToken()
    {
        $this->invitation_token = substr(md5(rand(0, 9).$this->email.time()), 0, 32);
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return urldecode(route('accept-invitation.create').'?invitation_token='.$this->invitation_token);
    }

    public function getInvitationDate()
    {
        return $this->invited_date->format('d F Y');
    }

    public function getRegisterTime()
    {
        return $this->registered_at->format('d F Y');
    }

    public function scopeSearch($query, $value)
    {
        $query->where('email', 'like', "%{$value}%");
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'invited_date' => 'datetime',
            'registered_at' => 'datetime',
        ];
    }
}
