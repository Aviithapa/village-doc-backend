<?php

namespace App\Http\Requests\Patients;

use App\Models\Patients;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePatientsRequest extends FormRequest
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
        $genderRule = Rule::in(Patients::GENDER);
        $maritalRule = Rule::in(Patients::MARITAL_STATUS);
        return [
            'first_name' => 'filled|max:255',
            'last_name' => 'filled|max:255',
            'date_of_birth' => 'filled|date|date_format:Y-m-d',
            'gender' => ['sometimes', 'required', 'max:255', $genderRule],
            'contact_number' => 'filled|max:255',
            'address' => 'sometimes|required',
            'ward_no'   => 'required',
            'marital_status' => ['sometimes', 'required', 'max:255', $maritalRule],
            'age' => 'required|integer',
            'religion' => 'required|max:255',
            'is_house_head' => 'boolean',
            'househead_no' => 'required',
            'citizenship_no' => 'sometimes|required',
            'blood_group' => 'sometimes|required',
            'insurance_no' => 'sometimes|required',
            'nid_no' => 'sometimes|required',
            'province_id' => 'required',
            'district_id' => 'required',
            'municipality_id' => 'required',
        ];
    }
}
