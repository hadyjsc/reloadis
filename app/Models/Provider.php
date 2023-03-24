<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'logo', 'color', 'created_at'];

    protected $hidden = ['id', 'name', 'logo', 'color', 'created_at', 'updated_at'];

    /**
     * Get all of the provider for the Provider
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function provider(): HasMany
    {
        return $this->hasMany(Provider::class, 'provider_id', 'id');
    }
}
