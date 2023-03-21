<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductItem extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'serial_number'];

    protected $hidden = ['id', 'product_id', 'serial_number', 'is_sold', 'sold_at', 'sold_by', 'created_by', 'updated_by', 'created_at', 'updated_at'];

    /**
     * Get the product that owns the ProductItem
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class)->withDefault();
    }
}
