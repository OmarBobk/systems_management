<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Sale extends Model
{
    use HasFactory;

    public $guarded = [];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function saletype(): BelongsTo
    {
        return $this->belongsTo(Saletype::class);
    }

    public function profits(): HasMany
    {
        return $this->hasMany(Income::class)->whereType('profit');
    }

    public function costs(): HasMany
    {
        return $this->hasMany(Income::class)->whereType('cost');
    }

    public function contribution(): BelongsTo
    {
        return $this->belongsTo(Contribution::class);
    }

    public function saleable(): MorphTo
    {
        return $this->morphTo();
    }

}
