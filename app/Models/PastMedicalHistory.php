<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PastMedicalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'medical_history',
        'surgical_history',
        'family_history',
        'personal_history',
    ];

    public function patients(): BelongsTo
    {
        return $this->belongsTo(Patients::class);
    }
}
