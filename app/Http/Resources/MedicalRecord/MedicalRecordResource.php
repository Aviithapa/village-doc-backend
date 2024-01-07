<?php

namespace App\Http\Resources\MedicalRecord;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicalRecordResource extends JsonResource
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
            'treatment_history' => $this->treatment_history,
            'patient' => $this->patient,
            'vitals' => $this->vitals,
            'medias' => $this->patient->medias,
            'prescription' => $this->prescription,
            'appointment' => $this->appointment,
            'status' => $this->status,
            'reproductive_plan' => $this->reproductive_plan,
            'patient_history' => $this->patientHistory,
            'medicalRecordDetails' => $this->medicalRecordDetails,
            'menstrualHistory' => $this->menstrualHistory,
            'complain' => MedicalRecordComplaintResource::collection($this->complain),
            'examination' => $this->examination
        ];
    }
}
