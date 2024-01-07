<?php

namespace App\Http\Requests\MedicalRecord;

use App\Models\Prescription;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateMedicalRecordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
            // 'diagnosis' => 'required',
            // 'notes' => 'required',
            'record_date' => 'required|date|date_format:Y-m-d',
            'patient_id' => 'required|exists:patients,id',
            'from' => ['sometimes', 'required', 'max:255', $fromRule],
        ];
    }
}
