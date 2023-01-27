<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Saletype extends Model
{
    use HasFactory;

    public $guarded = [];

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    /**
     *
     * @return HasMany
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     *
     * @return HasMany
     */
    public function default(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
