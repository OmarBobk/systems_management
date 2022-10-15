<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsDatabase extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    public $searchable_columns = [
        'code', 'name', 'serial'
    ];

    public $return_from_search = [];


    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
