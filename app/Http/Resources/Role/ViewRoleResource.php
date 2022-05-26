<?php

namespace App\Http\Resources\Role;

use Illuminate\Http\Resources\Json\JsonResource;

class ViewRoleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'users' => $this->users->pluck('name'),
            'permissions' => $this->permissions->pluck('name'),
        ];
    }
}
