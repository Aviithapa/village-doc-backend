<?php

namespace App\Http\Requests\LabResult;

use Illuminate\Foundation\Http\FormRequest;

class CreateLabResultRequest extends FormRequest
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
            'test_name' => 'required',
            'notes' => 'required',
            'result' => 'required',
            'test_date' => 'required|date|date_format:Y-m-d',
            'patient_id' => 'required|exists:patients,id',
            'medical_record_id' => 'nullable|exists:medical_records,id',

        ];
    }
}
