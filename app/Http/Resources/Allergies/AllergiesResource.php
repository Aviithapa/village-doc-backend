<?php

namespace App\Http\Resources\Allergies;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllergiesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"   => $this->id,
            "allergen_name"  => $this->allergen_name,
            'reaction'  => $this->reaction,
            'patient' => $this->patient,
        ];
    }
}
