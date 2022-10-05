<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SlidercontentResource extends JsonResource
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
            'sub_title' => $this->sub_title,
            'url' => $this->url,
            'image' => $this->image,
            'sm_image' => $this->sm_image,
            'order' => $this->order,

            'relationships' => [
                'small_image' => (new ImageResource($this->whenLoaded('small_image')))->only(['id', 'path']),
                'big_image' => (new ImageResource($this->whenLoaded('big_image')))->only(['id', 'path']),
            ],
        ];
    }
}
