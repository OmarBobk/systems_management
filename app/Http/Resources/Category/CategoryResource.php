<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Image\ImageResource;
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
            'relationship' => [
                'image' => (new ImageResource($this->whenLoaded('image'))),
                'childrenCategories' => CategoryResource::collection($this->whenLoaded('childrenCategories')),
                'categories' => CategoryResource::collection($this->whenLoaded('categories')),
                'parent' => new CategoryResource($this->whenLoaded('parent')),
            ],
        ];
    }
}
