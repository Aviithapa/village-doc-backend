<?php

namespace App\Http\Requests\Vital;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVitalRequest extends FormRequest
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
        return [
            'height' => 'sometimes|string',
            'weight' => 'sometimes|string',
            'blood_pressure' => 'sometimes|required|max:255',
            'heart_rate' => 'sometimes|required|max:255',
            'temperature' => 'sometimes|required|max:255',
            'date_of_measurement' => 'sometimes|required|date|date_format:Y-m-d',
            'patient_id' => 'required|exists:patients,id',
        ];
    }
}
