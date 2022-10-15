<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Image\ImageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetShortProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id'        => $this->id,
            'name'      => __('products.'.str_replace(' ', '_', strtolower($this->name))),
            'price'     => $this->price,
            'category'  => $this->category_id,
            'slug'      => $this->slug,
            'image'     => new ImageResource($this->whenLoaded('shortproduct_image')->first()),
        ];
    }
}
