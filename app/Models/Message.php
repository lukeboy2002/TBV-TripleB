<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Message extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'recipient_id',
        'content',
        'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    // Sender relationship
    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Recipient relationship
    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    // Mark message as read
    public function markAsRead(): void
    {
        if (! $this->is_read) {
            $this->is_read = true;
            $this->save();
        }
    }
}
