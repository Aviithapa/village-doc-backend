<?php

namespace App\Http\Resources\Patients;

use App\Http\Resources\MedicalRecord\MedicalRecordResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientsResource extends JsonResource
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
            "first_name"  => $this->first_name,
            'last_name'  => $this->last_name,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'contact_number' => $this->contact_number,
            'address' => $this->address,
            'vitals' => $this->vitals,
            'medical_records' => MedicalRecordResource::collection($this->medicalRecords),
            'latest_visit' => $this->latestMedicalRecord,
            'allergies' => $this->allergies,
            'medias' => $this->medias,
        ];
    }
}
