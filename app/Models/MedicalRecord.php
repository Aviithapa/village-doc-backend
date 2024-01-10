<?php

namespace App\Models;

use App\Infrastructure\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalRecord extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasFilter;

    const TYPE_PENDING = "PENDING";
    const TYPE_APPOINTMENT = "APPOINTMENT BOOKED";
    const TYPE_CONSULTING = "CONSULTING";
    const TYPE_RESCHEDULED = "RESCHEDULED";
    const TYPE_FOLLOW_UP = "FOLLOW UP";
    const TYPE_CLOSED = "CLOSED";

    const RECORD_TYPE = [
        self::TYPE_PENDING,
        self::TYPE_APPOINTMENT,
        self::TYPE_CONSULTING,
        self::TYPE_RESCHEDULED,
        self::TYPE_FOLLOW_UP,
        self::TYPE_CLOSED,
    ];

    protected $fillable = [
        'patient_id',
        'record_date',
        'treatment_history',
        'reproductive_plan',
        'status',
        'created_by',
        'updated_by',
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patients::class, 'patient_id', 'id');
    }

    public function vitals(): HasMany
    {
        return $this->hasMany(Vital::class, 'medical_record_id', 'id');
    }

    public function prescription(): HasMany
    {
        return $this->hasMany(Prescription::class, 'medical_record_id', 'id');
    }

    public function appointment(): HasMany
    {
        return $this->hasMany(Appointment::class, 'medical_record_id', 'id');
    }

    public function medias(): HasMany
    {
        return $this->hasMany(Medias::class, 'medical_record_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function patientHistory(): HasMany
    {
        return $this->hasMany(PatientHistory::class, 'medical_record_id', 'id');
    }

    public function medicalRecordDetails(): HasMany
    {
        return $this->hasMany(MedicalRecordDetails::class, 'medical_record_id', 'id');
    }

    public function menstrualHistory(): BelongsTo
    {
        return $this->belongsTo(MenstrualHistory::class, 'medical_record_id', 'id');
    }

    public function obstreticHistory(): BelongsTo
    {
        return $this->belongsTo(ObstreticHistory::class, 'medical_record_id', 'id');
    }

    public function complain(): HasMany
    {
        return $this->hasMany(MedicalRecordComplaint::class, 'medical_record_id', 'id');
    }

    public function examination(): HasMany
    {
        return $this->hasMany(Examinations::class, 'medical_record_id', 'id');
    }

    public function medication(): HasMany
    {
        return $this->hasMany(Medication::class, 'medical_record_id', 'id');
    }
}
