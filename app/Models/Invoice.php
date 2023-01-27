<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * @return HasMany
     */
    public function invoicerecords(): HasMany
    {
        return $this->hasMany(Invoicerecord::class);
    }

    public function recordsPrice(): int
    {
        return $this->invoicerecords()?->sum('price');
    }

    public function recordsCost(): int
    {
        return $this->invoicerecords()?->sum('cost');
    }

    /**
     * @return BelongsTo
     */
    public function invoicecustomer(): BelongsTo
    {
        return $this->belongsTo(Invoicecustomer::class);
    }

}
