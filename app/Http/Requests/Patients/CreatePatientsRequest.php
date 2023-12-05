<?php

namespace App\Http\Requests\Patients;

use App\Models\Medias;
use App\Models\Patients;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreatePatientsRequest extends FormRequest
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
        return [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'date_of_birth' => 'required|date|date_format:Y-m-d',
            'gender' => ['sometimes', 'required', 'max:255', $genderRule],
            'contact_number' => 'required|max:255',
            'address' => 'required',
            'images' => 'required',
            'ward_no'   => 'required'
        ];
    }
}
