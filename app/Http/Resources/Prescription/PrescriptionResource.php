<?php

namespace App\Http\Resources\Prescription;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionResource extends JsonResource
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
            "from"  => $this->from,
            'prescription_date'  => $this->prescription_date,
            'suggested_treatment' => $this->suggested_treatment,
            'notes' => $this->notes,
            'implement' => $this->implement,
        ];
    }
}
