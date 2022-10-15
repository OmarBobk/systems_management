<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Category extends Model
{
    use HasFactory;

    public $guarded = [];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function products_in_parent_category(): HasManyThrough
    {
        return $this->hasManyThrough(
            related: Product::class,
            through: Category::class,
            firstKey: 'category_id',
            secondKey: 'category_id',
        );
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function childrenCategories(): HasMany
    {
        return $this
            ->hasMany(Category::class, 'category_id')
            ->with('categories');
    }

    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }

// - Chargers
//   - PD Chargers
//     - Lightning Chargers
//     - Type-C Chargers
//       - Kensa.
//       - Concord.
//   - 1.0A Chargers
//     - Iphone Chargers
//     - Nokia Chargers
}
