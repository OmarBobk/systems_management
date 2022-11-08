<?php

namespace App\Http\Resources\Roles;

use App\Http\Resources\Permissions\GetPermissionsResource;
use Illuminate\Http\Resources\Json\JsonResource;

class GetRolesResource extends JsonResource
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
            'permissions' => GetPermissionsResource::collection($this->whenLoaded('permissions')),
        ];
    }
}
