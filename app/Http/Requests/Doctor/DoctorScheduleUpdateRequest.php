<?php

namespace App\Http\Requests\Doctor;

use App\Models\DoctorSchedule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DoctorScheduleUpdateRequest extends FormRequest
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
        $daysRule = Rule::in(DoctorSchedule::DAYS);
        $shiftRule = Rule::in(DoctorSchedule::SHIFTS);

        return [
            'doctor_id' => 'required',
            'name'  => 'required',
            'day_of_week'   => ['required',$daysRule],
            'day_period'    => ['required', $shiftRule],
            'work_from' => 'required',
            'work_to'   => 'required',
            'date'  => 'required|date'
        ];
    }
}
