<?php

namespace App\Http\Resources\Doctor;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DoctorScheduleResource extends JsonResource
{
    /**
         * Transform the resource into an array.
         * @param  \Illuminate\Http\Request  $request
         * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
    */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name' => $this->name,
            'day_of_week' => $this->day_of_week,
            'day_period' => $this->day_period,
            'work_from' => $this->work_from,
            'work_to' => $this->work_to,
            'date' => $this->date,
            'doctor' => $this->doctor,
        ];
    }
}
