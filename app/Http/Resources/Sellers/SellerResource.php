<?php

namespace App\Http\Resources\Sellers;

use App\Http\Resources\Brand\BrandResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'address' => $this->address,
            'relationships' => [
                'brands' => BrandResource::collection($this->whenLoaded('brands')),
            ],
        ];
    }
}
