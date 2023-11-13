<?php

namespace App\Http\Requests\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patient_id' => 'sometimes|required|exists:patients,id',
            'doctor_id' => 'sometimes|nullable|exists:doctors,id',
            'medical_record_id' => 'sometimes|nullable|exists:medical_records,id',
            'appointment_date' => 'sometimes|required|date',
            'appointment_time' => 'sometimes|required|date_format:H:i',
            'reason' => 'sometimes|required|string',
            'status' => 'sometimes|required|in:queried,scheduled,completed,canceled',
            'urgent' => 'sometimes|boolean',
        ];
    }
}
