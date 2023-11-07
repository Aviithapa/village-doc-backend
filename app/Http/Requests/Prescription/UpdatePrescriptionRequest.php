<?php

namespace App\Http\Requests\Prescription;

use App\Models\Prescription;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePrescriptionRequest extends FormRequest
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
        $fromRule = Rule::in(Prescription::FROM);
        return [
            //
            'from' => ['sometimes', 'required', 'max:255', $fromRule],
            'notes' => 'required',
            'suggested_treatment' => 'required',
            'implementation' => 'sometimes|boolean',
            'prescription_date' => 'required|date|date_format:Y-m-d',
            'patient_id' => 'required|exists:patients,id',
            'medical_record_id' => 'nullable|exists:medical_records,id',

        ];
    }
}
