<?php

namespace App\Http\Resources\LabResult;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabResultResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"   => $this->id,
            "medical_record"  => $this->medicalRecord,
            "test_date"  => $this->test_date,
            'notes'  => $this->notes,
            'test_name' => $this->test_name,
            'result' => $this->result,
        ];
    }
}
