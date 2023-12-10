<?php

namespace App\Models;

use App\Infrastructure\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes, HasFilter;

    const STATUS_QUERIED = "QUERIED";
    const STATUS_SCHEDULED = "SCHEDULED";
    const STATUS_COMPLETED = "COMPLETED";
    const STATUS_CANCELED = "CANCELED";
    const STATUS_RESCHEDULED = "RESCHEDULED";

    const STATUS = [
        self::STATUS_SCHEDULED,
        self::STATUS_SCHEDULED,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELED,
        self::STATUS_RESCHEDULED
    ];

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'medical_record_id',
        'appointment_date',
        'appointment_time',
        'reason',
        'status',
        'urgent',
        'created_by',
        'updated_by'
    ];

    public function patient()
    {
        return $this->belongsTo(Patients::class, 'patient_id', 'id');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id', 'id');
    }

    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id', 'id');
    }
}
