<?php

namespace App\Models;

use App\Infrastructure\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prescription extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasFilter;

    const FROM_AI = 'AI';
    const FROM_PHYSICIAN = 'PHYSICIAN';
    const FROM_HEALTH_WORKER = 'HEALTH-WORKER';
    const FROM_APPOINTMENT = 'APPOINTMENT';

    const FROM = [
        self::FROM_AI,
        self::FROM_PHYSICIAN,
        self::FROM_HEALTH_WORKER,
        self::FROM_APPOINTMENT
    ];

    protected $fillable = [
        'from',
        'patient_id',
        'medical_record_id',
        'prescription_date',
        'suggested_treatment',
        'notes',
        'implement',
        'provisional_diagnosis',
        'examination'
    ];
}
