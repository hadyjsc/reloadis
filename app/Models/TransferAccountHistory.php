<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Bank;

class TransferAccountHistory extends Model
{
    use HasFactory;

    protected $fillable = ['bank_id', 'name', 'bank_account', 'created_by', 'created_at'];

    protected $hidden = ['id', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    /**
     * Get the bank that owns the TransferAccountHistory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bank(): BelongsTo
    {
        return $this->belongsTo(Bank::class)->withDefault();
    }
}
