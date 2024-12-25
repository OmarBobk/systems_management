<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;

class Product extends Model
{
    use HasFactory, Searchable, SchemalessAttributesTrait;

    public $searchable_columns = [
        'code', 'name', 'description', 'serial'
    ];

    public $return_from_search = [];

    public $guarded = [];

    protected $schemalessAttributes = [
        'extra_attributes',
        'description',
    ];


    public function scopeWithExtraAttributes(): Builder
    {
        return $this->extra_attributes->modelScope();
    }

    public function scopeWithDescription(): Builder
    {
        return $this->description->modelScope();
    }

    public function colors()
    {
        return $this->extra_attributes->get('color.*.value');
    }


    public function sizes()
    {
        return $this->extra_attributes->get('size.*.value');
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsToMany
     */
    public function carts(): BelongsToMany
    {
        return $this->belongsToMany(Cart::class)->withPivot('id', 'code', 'name', 'amount', 'net_price', 'net_cost', 'description');
    }

    public function contribution(): BelongsTo
    {
        return $this->belongsTo(Contribution::class)->whereStatus(0);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

    public function bill(): BelongsTo
    {
        return $this->belongsTo(Bill::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function shortproduct_image(): MorphMany
    {
        return $this->images()->where('order', 0);
    }

    public function productsection(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function sales(): MorphMany
    {
        return $this->morphMany(Sale::class, 'saleable');
    }



}
