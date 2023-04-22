<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'location', 'image', 'created_at', 'created_by', 'updated_at', 'updated_by'];

    protected $hidden = ['id', 'updated_at', 'updated_by'];

    /**
     * Get all of the users for the Branch
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }
}
