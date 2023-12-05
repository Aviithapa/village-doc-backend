<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'salutation' => $this->salutation,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'Specialization' => $this->Specialization,
            'nmc_number' => $this->nmc_number,
            'gender' => $this->gender,
            'contact_number' => $this->contact_number,
            'emergency_contact_number' => $this->emergency_contact_number,
            'hiring_date' => $this->hiring_date,
            'email' => $this->email,
            'address' => $this->address,
        ];
    }
}
