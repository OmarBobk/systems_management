<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Builder;
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

    /**
     * @throws Exception
     */
    public function products_in_category(Builder $query): Builder
    {
        $childrens = $this->childrenCategories;

        if ($childrens->isEmpty())
            // The Category has no childrens
            return $query->where('category_id', $this->id);
        else
            if ($this->parent != null) {
                // Category has children and Parent
                return $query->whereIn('category_id', $childrens->modelKeys());
            } else {
                // Category is a Grand father category.
                throw new Exception('It\'s not available to get Products By a Grand Father Category, it either a parent category or a son category');
            }
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
