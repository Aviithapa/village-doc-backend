<?php

namespace App\Http\Requests\MedicalRecord;

use App\Models\MedicalRecordDescription;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MedicalRecordStatusRequest extends FormRequest
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
        $statusRule = Rule::in(MedicalRecordDescription::STATUS);

        return [
            'medical_record_id' => 'required|exists:medical_records,id',
            'status' => ['required',$statusRule]
        ];
    }
}
