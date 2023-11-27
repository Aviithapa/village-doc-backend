<?php

namespace App\Http\Requests\Medication;

use App\Models\Medication;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $formRule = Rule::in(Medication::FORM);
        $routeRule = Rule::in(Medication::ROUTE);

        return [
            'prescription_id'  => 'required|integer|exists:prescriptions,id',
            'medication_name' => 'required|string|max:255',
            'dosage' => 'required',
            'quantity' => 'required',
            'form' => ['nullable',$formRule],
            'route' => ['nullable', $routeRule]
        ];
    }
}
