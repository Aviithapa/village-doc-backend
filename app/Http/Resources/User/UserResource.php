<?php

namespace App\Http\Resources\User;

use App\Models\Role;
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
            "id"      => $this->id,
            "username"    => $this->username,
            "email"  => $this->email,
            "phone_number" => $this->phone_number,
            "status" => $this->status,
            "role" => $this->roles,
        ];
    }
}
