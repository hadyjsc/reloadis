<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = ['sender', 'bank_id', 'uuid', 'status', 'note', 'bank_account', 'receiver', 'amount', 'created_by', 'created_at'];

    protected $hidden = ['id',  'receipt', 'created_by', 'updated_by', 'created_at', 'updated_at'];
}
