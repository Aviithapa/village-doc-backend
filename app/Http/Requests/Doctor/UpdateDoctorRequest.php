<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDoctorRequest extends FormRequest
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
        $userId = $this->route('doctor');
        return [
            'salutation' => 'nullable|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'Specialization' => 'required|string|max:255',
            'nmc_number' => ['required',Rule::unique('doctors')->ignore($userId),'max:255'],
            'gender' => 'required|in:MALE,FEMALE,OTHER',
            'contact_number' => 'nullable|string|max:255',
            'emergency_contact_number' => 'nullable|string|max:255',
            'hiring_date' => 'required|date',
            'email' => [Rule::unique('doctors')->ignore($userId),'required','email','max:255'],
            'address' => 'required|string',
        ];
    }
}
