<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BMI extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'medical_record_bmi';

    protected $fillable = [
        'medical_record_id',
        'patient_id',
        'height',
        'weight',
        'bmi',
    ];

    public function MedicalRecord(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id', 'id');
    }
}
