<?php

namespace App\Http\Resources\ProductsectionProducts;

use App\Http\Resources\Image\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;
use function __;

class ProductsectionProductsResource extends JsonResource
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
            'id'     => $this->id,
            'name'   => __('products.'.str_replace(' ', '_', strtolower($this->name))),
            'price'  => $this->price,
            'slug'   => $this->slug,
            'image'  => new ImageResource($this->whenLoaded('productsection_image')->first()),
        ];
    }
}
