<?php

namespace App\Http\Resources\Vital;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VitalResource extends JsonResource
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
            "blood_pressure"  => $this->blood_pressure,
            "pulse"  => $this->pulse,
            "temperature"  => $this->temperature,
            "respiration"  => $this->respiration,
            "saturation"  => $this->saturation,
            'follow_up' => $this->follow_up,
        ];
    }
}
