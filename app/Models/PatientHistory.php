<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'medical_history',
        'surgical_history',
        'personal_history',
        'birth_history',
        'family_history',
        'treatment_history',
        'immunization_history',
        'nutrition_history',
        'development_history',
        'contraception_history',
        'reproductive_plans',
        'medical_record_id',
        'patient_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'contraception_history' => 'array',
        'personal_history' => 'array',
        'family_history' => 'array',
    ];

    public function medicalRecords(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
