<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalRecordComplaint extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'complaint_id',
        'medical_record_id',
        'duration'
    ];

    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class,'complaint_id','id');
    }

    public function medical_record(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class,'medical_record_id','id');
    }
}
