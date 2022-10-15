<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return BelongsToMany
     */
    public function sellers(): BelongsToMany
    {
        return $this->belongsToMany(Seller::class, 'brand_seller', 'brand_id', 'seller_id');
    }

}
