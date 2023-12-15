<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalRecordDescription extends Model
{
    use HasFactory;

    const STATUS_CONNECTED = "CONNECTED";
    const STATUS_NOT_CONNECTED = "NOT CONNECTED";
    const STATUS_THIRD_PERSON = "THIRD PERSON";

    const STATUS = [
        self::STATUS_CONNECTED,
        self::STATUS_NOT_CONNECTED,
        self::STATUS_THIRD_PERSON
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
