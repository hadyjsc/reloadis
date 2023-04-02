<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Bank;
use App\Models\TransferHistory;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = ['sender', 'bank_id', 'uuid', 'status', 'note', 'bank_account', 'receiver', 'amount', 'created_by', 'created_at'];

    protected $hidden = ['id',  'receipt', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    /**
     * Get the bank that owns the Transfer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class)->withDefault();
    }

    /**
     * Get all of the history for the Transfer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function history(): HasMany
    {
        return $this->hasMany(TransferHistory::class, 'transfer_id', 'id');
    }
}
