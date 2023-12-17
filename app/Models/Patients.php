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

    const MARITAL_STATUS_SINGLE = 'SINGLE';
    const MARITAL_STATUS_MARRIED = 'MARRIED';
    const MARITAL_STATUS_DIVORCED = 'DIVORCED';

    const GENDER = [
        self::GENDER_MALE,
        self::GENDER_FEMALE,
        self::GENDER_OTHER
    ];

    const MARITAL_STATUS = [
        self::MARITAL_STATUS_SINGLE,
        self::MARITAL_STATUS_MARRIED,
        self::MARITAL_STATUS_DIVORCED
    ];

    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'contact_number',
        'address',
        'uuid',
        'ward_no',
        'created_by',
        'updated_by',
        'age',
        'religion',
        'marital_status',
        'is_house_head',
        'contact_no',
        'househead_no',
        'parent_id',
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

    public function medias(): HasMany
    {
        return $this->hasMany(Medias::class, 'patient_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function familyMembers(): hasMany
    {
        return $this->hasMany(Patients::class,'patient_id','id');
    }
}
