<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Hasmany;
use App\Models\Category;
use App\Models\Provider;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'provider_id', 'quota', 'unit', 'price', 'fund', 'fund_date', 'created_by', 'stocked'];

    protected $hidden = ['id', 'category_id', 'provider_id', 'description', 'quota', 'unit', 'price', 'fund', 'fund_date', 'stocked', 'is_deleted', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    /**
     * Get the provider that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class)->withDefault();
    }

    /**
     * Get all of the productItem for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productItem(): HasMany
    {
        return $this->hasMany(ProductItem::class, 'product_id', 'id');
    }
}
