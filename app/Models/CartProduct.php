<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CartProduct extends Pivot
{
    protected $table = 'cart_product';

    /**
     * Get the Total Price.
     *
     * @return Attribute
     */
    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->amount * $this->net_price / 1000, 3),
        );
    }

    /**
     * Get the total Profits
     *
     * @return Attribute
     */
    protected function totalProfits(): Attribute
    {
        return Attribute::make(
            get: fn () => number_format($this->amount * ($this->net_price - $this->net_cost) / 1000, 3),
        );
    }

    /**
     * Get the Updated at human-readable
     *
     * @return Attribute
     */
    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->updated_at->format('m-d H:i a'),
        );
    }


}
