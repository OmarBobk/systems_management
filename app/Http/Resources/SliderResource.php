<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SliderResource extends JsonResource
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
            'title'  => $this->title,
            'status' => $this->status,
            'order'  => $this->order,

            'relationships' => [
                'image' => (new ImageResource($this->whenLoaded('background')))->only(['id', 'path']),
                'slidercontents' => SlidercontentResource::collection($this->whenLoaded('slidercontents')),
            ],
        ];
    }
}
