<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
    public function brands(): BelongsToMany
    {
        return $this->belongsToMany(Brand::class, 'brand_seller', 'seller_id', 'brand_id');
    }
}
