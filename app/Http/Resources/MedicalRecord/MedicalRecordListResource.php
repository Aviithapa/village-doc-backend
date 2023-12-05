<?php

namespace App\Http\Resources\MedicalRecord;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicalRecordListResource extends JsonResource
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
            "record_date"  => $this->record_date,
            'notes'  => $this->notes,
            'diagnosis' => $this->diagnosis,
            'patient' => $this->patient
        ];
    }
}
