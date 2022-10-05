<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\ImageResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'status' => $this->status,
            'relationship' => [
                'image' => (new ImageResource($this->whenLoaded('image')))->only(['id', 'path']),
                'childrenCategories' => CategoryResource::collection($this->whenLoaded('childrenCategories')),
                'categories' => CategoryResource::collection($this->whenLoaded('categories')),
            ],
        ];
    }
}
