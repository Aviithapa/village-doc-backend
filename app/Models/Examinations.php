<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examinations extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'well_oriented',
        'in_pain',
        'eye_opening_gcs',
        'verbal_response_gcs',
        'motor_response_gcs',
        'inspection',
        'palpation',
        'percussion',
        'auscultation',
        'head_toe_examination',
        'from',
        'created_by',
        'updated_by',
        'medical_record_id'
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
