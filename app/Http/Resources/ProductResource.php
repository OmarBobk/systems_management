<?php

namespace App\Http\Resources;

use App\Http\Resources\Category\CategoryResource;
use App\Models\Bill;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Contribution;
use App\Models\User;
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
            'name'              => __('products.'.str_replace(' ', '_', strtolower($this->name))),
            'description'       => json_decode($this->description),
            'code'              => $this->code,
            'price'             => $this->price,
            'slug'              => $this->slug,

            'relationships'     => [
//                'category' => (new CategoryResource($this->whenLoaded('category')))->attributes(['name', 'slug'])->data,
                'category'   => (new CategoryResource($this->whenLoaded('category'))),
                'brand'      => (new BrandResource($this->whenLoaded('brand'))),
//                'attributes' => AttributeResource::collection($this->whenLoaded('attributes')),
            ],
        ];
    }
}
