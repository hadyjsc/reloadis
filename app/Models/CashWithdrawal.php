<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashWithdrawal extends Model
{
    use HasFactory;

    protected $fillable = ['bank_id', 'amount', 'external_fee', 'internal_fee', 'created_at', 'created_by'];

    protected $hidden = ['id', 'created_at', 'created_by', 'updated_at', 'updated_by'];
}
