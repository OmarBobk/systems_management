<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
