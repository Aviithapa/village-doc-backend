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

    protected $fillable = [
        'patient_id',
        'record_date',
        'notes',
        'diagnosis',
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
