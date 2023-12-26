<?php

namespace App\Http\Resources\Patients;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientFamilyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'date_of_birth' => $this->date_of_birth,
            'gender' => $this->gender,
            'blood_group' => $this->blood_group,
            'religion' => $this->religion,
            'contact_number' => $this->contact_number,
            'address' => $this->address,
            'patientNumber' => (isset($this->province->id) ? $this->province->id: '00') . '-' . (isset($this->district->id) ? $this->district->id: '00') . '-' . (isset($this->municipality->id) ? $this->municipality->id: '00') . '-' . $this->id,
            'full_address' => (isset($this->province->name) ? $this->province->name: '00') . '-' . (isset($this->district->name) ? $this->district->name: '00') . '-' . (isset($this->municipality->name) ? $this->municipality->name: '00') . '-' . $this->address,
            'age' => $this->age,
            'patient_id' => $this->patient_id,
            'citizenship_no' => $this->citizenship_no,
            'uuid' => $this->uuid,
            'medias' => $this->medias[0]->path??"",
            'relationship' => $this->relationship,
        ];
    }
}
