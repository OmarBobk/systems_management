<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function contributions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Contribution::class);
    }

}
