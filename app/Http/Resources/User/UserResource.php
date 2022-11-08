<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Roles\GetRolesResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'verified' => (bool)$this->email_verified_at,
            'profile_photo' => '',
            'roles' => GetRolesResource::collection($this->whenLoaded('roles')),
        ];
    }
}
