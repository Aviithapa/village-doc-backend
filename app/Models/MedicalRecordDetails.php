<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalRecordDetails extends Model
{
    use HasFactory;
    use SoftDeletes;

    const FROM_AI = 'AI';
    const FROM_PHYSICIAN = 'PHYSICIAN';
    const FROM_HEALTH_WORKER = 'HEALTH-WORKER';
    const FROM_DOCTOR = 'DOCTOR';


    const FROM = [
        self::FROM_AI,
        self::FROM_PHYSICIAN,
        self::FROM_HEALTH_WORKER,
        self::FROM_DOCTOR
    ];

    protected $fillable = [
        'hopi',
        'provisional_diagnosis',
        'from',
        'status',
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
