<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;

class ProductsDatabase extends Model
{
    use HasFactory, Searchable, SchemalessAttributesTrait;

    protected $guarded = [];
    protected $schemalessAttributes = [
        'extra_attributes',
        'description',
    ];

    public $searchable_columns = [
        'code', 'name', 'serial'
    ];

    public $return_from_search = [];

    public function scopeWithDescription(): Builder
    {
        return $this->description->modelScope();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
