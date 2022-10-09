<?php

namespace App\Http\Resources\Slider;

use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Slidercontent\SlidercontentResource;
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

            'relationships' => [
                'image' => (new ImageResource($this->whenLoaded('background'))),
                'slidercontents' => SlidercontentResource::collection($this->whenLoaded('slidercontents')),
            ],
        ];
    }
}
