<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 */
class Invoicecustomer extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];
    public $searchable_columns = [
        'name', 'phone'
    ];

    public $return_from_search = [];

    /**
     * @return HasMany
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}
