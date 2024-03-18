<?php

namespace App\Http\Requests\FollowUp;

use Illuminate\Foundation\Http\FormRequest;

class FollowUpRequest extends FormRequest
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
            'medical_record_id' => 'required|exists:medical_records,id,deleted_at,NULL',
            "add_on_symptom" => 'sometimes|required',
            "reaction" => 'sometimes|required',
            "condition" => 'sometimes|required',
            "medication" => 'sometimes|required',
        ];
    }
}
