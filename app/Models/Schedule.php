<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Branch;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'branch_id', 'start_time', 'end_time', 'is_active','created_at', 'created_by', 'updated_at', 'updated_by'];

    protected $hidden = ['id', 'is_active', 'updated_at', 'updated_by'];

    /**
     * Get the user that owns the Schedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    /**
     * Get the branch that owns the Schedule
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class)->withDefault();
    }
}
