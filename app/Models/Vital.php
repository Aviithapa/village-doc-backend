<?php

namespace App\Models;

use App\Infrastructure\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vital extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasFilter;

    protected $fillable = [
        'medical_record_id',
        'blood_pressure',
        'pulse',
        'temperature',
        'respiration',
        'saturation',
        'created_by',
        'updated_by'
    ];

    public function medical_records() : BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class,'medical_record_id','id');
    }
}
