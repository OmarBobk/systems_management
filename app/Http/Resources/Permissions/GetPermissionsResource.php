<?php

namespace App\Http\Resources\Permissions;

use App\Http\Resources\Roles\GetRolesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GetPermissionsResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'roles' => GetRolesResource::collection($this->whenLoaded('roles'))
        ];
    }
}
