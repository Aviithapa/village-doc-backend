<?php

namespace App\Models;

use App\Infrastructure\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalRecord extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasFilter;

    const TYPE_PENDING = "Pending";
    const TYPE_APPOINTMENT = "Appointment Booked";
    const TYPE_CONSULTING = "Consulting";
    const TYPE_RESCHEDULED = "Rescheduled";
    const TYPE_FOLLOW_UP = "Follow Up";
    const TYPE_CLOSED = "Closed";

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
        'notes',
        'diagnosis',
        'status'
    ];

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patients::class, 'patient_id', 'id');
    }

    public function vitals(): HasMany
    {
        return $this->hasMany(Vital::class, 'patient_id', 'id');
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
}
