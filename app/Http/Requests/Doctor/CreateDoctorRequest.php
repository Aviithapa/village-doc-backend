<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class CreateDoctorRequest extends FormRequest
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
            'salutation' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'Specialization' => 'required|string|max:255',
            'nmc_number' => 'required|unique:doctors,nmc_number|max:255',
            'gender' => 'required|in:MALE,FEMALE,OTHER',
            'contact_number' => 'nullable|string|max:255',
            'emergency_contact_number' => 'nullable|string|max:255',
            'hiring_date' => 'required|date',
            'email' => 'required|email|unique:doctors,email|max:255',
            'address' => 'required|string',
        ];
    }
}
