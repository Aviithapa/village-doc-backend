<?php

namespace App\Http\Resources\FollowUp;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FollowUpResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id'    => $this->id,
            'condition' => $this->condition,
            'reaction' => $this->reaction,
            'medication' => $this->medication,
            'add_on_symptom' => $this->add_on_symptom,
            'medical_record' => $this->medical_record,
            'vitals' => $this->vitals,
        ];
    }
}
