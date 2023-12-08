<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalRecordDescription extends Model
{
    use HasFactory;

    const STATUS = [
        'CONNECTED','NOT CONNECTED','THIRD PERSON'
    ];

    protected $fillable = [
        'medical_record_id',
        'description',
        'reaction',
        'status',
        'prescription',
        'consult_doctor',
        'created_by',
        'updated_by'
    ];

    public function medical_records(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class, 'patient_id', 'id');
    }
}
