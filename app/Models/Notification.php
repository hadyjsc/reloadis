<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'subject', 'sender', 'data', 'response', 'created_at', 'updated_at', 'created_by', 'updated_by'];

    protected $hidden = ['id', 'created_at', 'updated_at', 'created_by', 'updated_by'];

    /**
     * Get the user that owns the Notification
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
