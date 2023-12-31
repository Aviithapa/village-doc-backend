<?php

namespace App\Http\Resources\Appointment;

use App\Http\Resources\MedicalRecord\MedicalRecordResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentListResource extends JsonResource
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
            'appointment_date' => $this->appointment_date,
            'appointment_time' => $this->appointment_time,
            'reason' => $this->reason,
            'status' => $this->status,
            'urgent' => $this->urgent,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'patient' => $this->medicalRecord->patient,
            'doctor_id' => $this->doctor_id,
            'medicalRecord' => $this->medicalRecord,
            'user' => $this->medicalRecord->user
        ];
    }
}
