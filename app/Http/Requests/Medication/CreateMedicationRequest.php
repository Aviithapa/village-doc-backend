<?php

namespace App\Http\Requests\Medication;

use Illuminate\Foundation\Http\FormRequest;

class CreateMedicationRequest extends FormRequest
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
            'prescription_id'  => 'required|integer|exists:prescriptions,id',
            'medication_name' => 'required|string|max:255',
            'dosage' => 'required',
            'quantity' => 'required',
            'form' => 'nullable|in:tablet,capsule,liquid',
            'route' => 'nullable|in:oral,intravenous,topical'
        ];
    }
}
