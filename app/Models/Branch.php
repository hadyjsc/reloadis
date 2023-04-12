<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'image', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    protected $hidden = ['id', 'updated_at', 'updated_by'];
}
