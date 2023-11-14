<?php

namespace App\Models;

use App\Infrastructure\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patients extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasFilter;

    const GENDER_MALE = 'MALE';
    const GENDER_FEMALE = 'FEMALE';
    const GENDER_OTHER = 'OTHER';

    const GENDER = [
        self::GENDER_MALE,
        self::GENDER_FEMALE,
        self::GENDER_OTHER
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'contact_number',
        'address',
        'uuid'
    ];

    public function vitals(): HasMany
    {
        return $this->hasMany(Vital::class, 'patient_id', 'id');
    }

    public function allergies(): HasMany
    {
        return $this->hasMany(Allergies::class, 'patient_id', 'id');
    }

    public function medicalRecords(): HasMany
    {
        return $this->hasMany(MedicalRecord::class, 'patient_id', 'id');
    }

    public function latestMedicalRecord(): HasOne
    {
        return $this->hasOne(MedicalRecord::class, 'patient_id', 'id')->latest();
    }

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class, 'patient_id', 'id');
    }
}
