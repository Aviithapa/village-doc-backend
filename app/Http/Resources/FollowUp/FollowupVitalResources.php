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
            "TPRBS"  => $this->TPRBS,
            'value'  => $this->value,
            'follow_up_id' => $this->follow_up_id,
        ];
    }
}
