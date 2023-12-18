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
            'uuid' => $this->uuid,
            'age' => $this->age,
            'ward_no' => $this->ward_no,
            'medical_records' => MedicalRecordResource::collection($this->medicalRecords),
            'latest_visit' => $this->latestMedicalRecord,
            'allergies' => $this->allergies,
            'medias' => $this->medias[0]->path,
            'family_details' => $this->familyMembers,
            'citizenship_no' => $this->citizenship_no,
            'insurance_no' => $this->insurance_no,
            'nid_no' => $this->nid_no,
            'blood_group' => $this->blood_group,
            'province' => isset($this->province) ? $this->province->name : '',
            'district' => isset($this->district) ? $this->district->name : '',
            'municipality' => isset($this->municipality) ? $this->municipality->name : '',
            'patientNumber' => $this->province->id . '-' . $this->district->id . '-' . $this->municipality->id . '-' . $this->id

        ];
    }
}
