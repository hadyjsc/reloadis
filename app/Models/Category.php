<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'name'];

    protected $hidden = ['id', 'type_id', 'name', 'created_at', 'updated_at'];

    /**
     * Get all of the subcategories for the Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategories(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id');
    }


    /**
     * Get the type that owns the Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class)->withDefault();
    }


}
