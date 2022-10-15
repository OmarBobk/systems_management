<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contribution extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }

    public function profits(): HasMany
    {
        return $this->hasMany(Income::class)->whereType('profit');
    }

    public function costs(): HasMany
    {
        return $this->hasMany(Income::class)->whereType('cost');
    }

    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function contributor(): BelongsTo
    {
        return $this->belongsTo(Contributor::class);
    }

}
