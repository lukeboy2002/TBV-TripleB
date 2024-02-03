<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'email',
        'invited_by',
        'invited_date',
        'invitation_token',
        'registered_at',
    ];

    protected $casts = [
        'invited_date' => 'datetime',
        'registered_at' => 'datetime',
    ];

    public function scopeSearch($query, $value) {
        $query->where('email', 'like', "%{$value}%")
            ->orWhere('invited_by', 'like', "%{$value}%");
    }

    /**
     * Generates a new invitation token.
     *
     * @return bool|string
     */
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
}
