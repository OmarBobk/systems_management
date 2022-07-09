<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'serial'            => (int) $this->serial,
            'name'              => $this->name,
            'description'       => $this->description,
            'code'              => $this->code,
            'amount'            => (int) $this->amount,
            'price'             => (int) $this->price,
            'cost'              => (int) $this->cost,
            'slug'              => $this->slug,
            'bill_id'           => $this->bill_id,
            'brand_id'          => $this->brand_id,
            'category_id'       => $this->category_id,
            'contribution_id'   => $this->contribution_id,
            'user_id'           => $this->user_id,
        ];
    }
}
