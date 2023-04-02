<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Transfer;

class TransferHistory extends Model
{
    use HasFactory;

    protected $fillable = ['transfer_id', 'status', 'created_by', 'created_at'];

    protected $hidden = ['id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    /**
     * Get the transfer that owns the TransferHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transfer(): BelongsTo
    {
        return $this->belongsTo(Transfer::class)->withDefault();
    }
}
