<?php

namespace App\Http\Resources\Patients;

use App\Http\Resources\MedicalRecord\MedicalRecordResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientListResource extends JsonResource
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
            'age' => $this->age,
            'blood_group' => $this->blood_group,
            'religion' => $this->religion,
            'full_address' => (isset($this->province->name) ? $this->province->name: '00') . '-' . (isset($this->district->name) ? $this->district->name: '00') . '-' . (isset($this->municipality->name) ? $this->municipality->name: '00') . '-' . $this->address,
            'citizenship_no' => $this->citizenship_no,
            'contact_number' => $this->contact_number,
            'address' => $this->address,
            'uuid' => $this->uuid,
            'medical_records' => MedicalRecordResource::collection($this->medicalRecords)->count(),
            'latest_visit' => $this->latestMedicalRecord->record_date??null,
            'relationship' => $this->relationship,
        ];
    }
}
