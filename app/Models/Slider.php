<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function background(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function slidercontents(): HasMany
    {
        return $this->hasMany(Slidercontent::class);
    }
}
