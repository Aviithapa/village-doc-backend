<?php

namespace App\Http\Resources\Medication;

use App\Http\Resources\Prescription\PrescriptionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicationResource extends JsonResource
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
            "medication_name"  => $this->medication_name,
            'dosage'  => $this->dosage,
            'quantity' => $this->quantity,
            'form'  => $this->form, // tablet, capsule, liquid
            'route' => $this->route,  // oral, intravenous, topical
        ];
    }
}
