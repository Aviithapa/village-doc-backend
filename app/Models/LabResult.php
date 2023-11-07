<?php

namespace App\Models;

use App\Infrastructure\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class LabResult extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasFilter;

    protected $fillable = [
        'patient_id',
        'medical_record_id',
        'test_date',
        'notes',
        'test_name',
        'result',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patients::class);
    }

    public function medicalRecord(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
