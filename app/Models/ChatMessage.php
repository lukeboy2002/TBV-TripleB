<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChatMessage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
    ];

    public function sender(): belongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver(): belongsTo
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
