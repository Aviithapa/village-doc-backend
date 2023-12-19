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
            'is_house_head' => $this->is_house_head,
            'age' => $this->age,
            'ward_no' => $this->ward_no,
            'medical_records' => MedicalRecordResource::collection($this->medicalRecords),
            'latest_visit' => $this->latestMedicalRecord,
            'allergies' => $this->allergies,
            'medias' => $this->medias[0]->path??"",
            'family_details' => PatientFamilyResource::collection($this->familyMembers),
            'citizenship_no' => $this->citizenship_no,
            'insurance_no' => $this->insurance_no,
            'nid_no' => $this->nid_no,
            'blood_group' => $this->blood_group,
            'province' => isset($this->province) ? $this->province->name : '',
            'district' => isset($this->district) ? $this->district->name : '',
            'municipality' => isset($this->municipality) ? $this->municipality->name : '',
            'patientNumber' => (isset($this->province->id) ? $this->province->id: '00') . '-' . (isset($this->district->id) ? $this->district->id: '00') . '-' . (isset($this->municipality->id) ? $this->municipality->id: '00') . '-' . $this->id

        ];
    }
}
