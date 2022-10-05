<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Slidercontent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function small_image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->where('name', 'LIKE', 'sm_%');
    }

    public function big_image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable')->where('name', 'NOT LIKE', 'sm_%');
    }

    public function slider(): BelongsTo
    {
        return $this->belongsTo(Slider::class);
    }

}
