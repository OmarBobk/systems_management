<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    public $guarded = [];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsToMany
     */
    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class)->withPivot('amount', 'net_price');
    }

//    public function seller(): BelongsTo
//    {
//        return $this->belongsTo(User::class);
//    }
//
//    public function factory(): BelongsTo
//    {
//        return $this->belongsTo(User::class);
//    }
//
//    public function contribution(): BelongsTo
//    {
//        return $this->belongsTo(User::class);
//    }
//
//    public function tags(): BelongsTo
//    {
//        return $this->belongsTo(User::class);
//    }

}
