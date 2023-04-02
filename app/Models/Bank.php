<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Transfer;
use App\Models\TransferAccountHistory;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo', 'created_at'];

    protected $hidden = ['id', 'name', 'logo', 'created_at', 'updated_at'];

    /**
     * Get all of the transfer for the Bank
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transfer(): HasMany
    {
        return $this->hasMany(Transfer::class, 'bank_id', 'id');
    }

    /**
     * Get all of the accountHistory for the Bank
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accountHistory(): HasMany
    {
        return $this->hasMany(TransferAccountHistory::class, 'bank_id', 'id');
    }
}
