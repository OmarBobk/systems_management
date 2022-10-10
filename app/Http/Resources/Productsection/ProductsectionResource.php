<?php

namespace App\Http\Resources\Productsection;

use App\Http\Resources\Product\GetShortProductResource;
use App\Http\Resources\ProductsectionProducts\ProductsectionProductsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductsectionResource extends JsonResource
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
            'title' => $this->title,
            'order' => $this->order,
            'category' => $this->category(),
            'products' => GetShortProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
