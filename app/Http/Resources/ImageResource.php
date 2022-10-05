<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'id'   => $this->id,
            'path' => $this->path,
            'name' => $this->name,
            'type' => $this->type,
            'imageable_type' => $this->imageable_type,
            'imageable_id' => $this->imageable_id,
            'order' => $this->order,
        ];
    }
}
