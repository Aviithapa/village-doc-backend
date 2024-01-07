<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObstreticHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'patient_id',
        'year_of_marriage',
        'no_of_pregnancy',
        'outcome_of_pregnancy',
        'complication_during_pregnancy',
        'mode_of_delivery',
        'amount_of_loss',
        'last_child_birth',
        'medical_record_id',
        'created_by',
        'updated_by',
    ];

    public function patients(): BelongsTo
    {
        return $this->belongsTo(Patients::class);
    }

    public function medicalRecords(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
