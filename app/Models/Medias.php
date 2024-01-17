<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Medias extends Model
{
    use HasFactory;

    const TYPE_PHOTO = 'PHOTO';
    const TYPE_TEST_REPORT = 'TEST_REPORT';
    const TYPE_SIGNATURE = 'SIGNATURE';
    const TYPE_OTHER = 'OTHER';


    const TYPES = [
        self::TYPE_PHOTO,
        self::TYPE_TEST_REPORT,
        self::TYPE_SIGNATURE,
        self::TYPE_OTHER,
    ];

    protected $table = 'medias';
    protected $appends = ['url'];

    protected $fillable = [
        'name',
        'original_name',
        'mime_type',
        'path',
        'collection',
        'disk',
        'patient_id',
        'medical_record_id',
        'type',
        'doctor_id'
    ];

    public function getUrlAttribute()
    {
        return $this->disk === 'local' ? Storage::disk('public')->url($this->path) : config('services.minio.minio_public_endpoint') . '/' . $this->path;
    }

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patients::class);
    }

    public function medicalRecord(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class);
    }
}
