<?php

namespace App\Http\Requests\FollowUp;

use App\Models\FollowUp;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $conditionRule = Rule::in(FollowUp::CONDITION);
        return [
            'medical_record_id' => 'required|exists:medical_records,id,deleted_at,NULL',
            "add_on_symptom" => 'sometimes|string|required',
            "reaction" => 'sometimes|string|required',
            "condition" => ['sometimes', 'required', $conditionRule],
            "medication" => 'sometimes|required|boolean',
        ];
    }
}
