<?php

namespace App\Http\Resources\Product;

use App\Http\Resources\Brand\BrandResource;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Image\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;
use function __;

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
            'name'              => __('products.'.str_replace(' ', '_', strtolower($this->name))),
            'slug'              => $this->slug,
            'city'              => $this->city,
            'code'              => $this->code,

            'serial'              => $this->serial,
            'price'             => $this->price,
            'cost'              => $this->cost,
            'amount'              => $this->amount,

            'description'       => $this->description,
            'extra_attributes'  => $this->extra_attributes,

            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,

            'relationships'     => [
//                'category' => (new CategoryResource($this->whenLoaded('category')))->attributes(['name', 'slug'])->data,
                'category'   => (new CategoryResource($this->whenLoaded('category'))),
                'brand'      => (new BrandResource($this->whenLoaded('brand'))),
//                'seller'      => (new SellerResource($this->whenLoaded('seller'))),
//                'user'      => (new SellerResource($this->whenLoaded('seller'))),
                'images'     => ImageResource::collection($this->whenLoaded('images')),
//                'attributes' => AttributeResource::collection($this->whenLoaded('attributes')),
            ],
        ];
    }
}
