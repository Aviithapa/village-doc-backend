<?php

namespace App\Models;

use App\Infrastructure\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FollowUp extends Model
{
    use HasFactory, HasFilter;
    const CONDITION_IMPROVING_SUBSIDE = 'IMPROVING-SUBSIDE';
    const CONDITION_NOT_IMPROVING = 'NOT-IMPROVING';


    const CONDITION = [
        self::CONDITION_IMPROVING_SUBSIDE,
        self::CONDITION_NOT_IMPROVING
    ];

    protected $fillable = [
        'medical_record_id',
        'add_on_symptom',
        'condition',
        'medication',
        'reaction'
    ];

    public function medical_record(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id', 'id');
    }

    public function vitals(): HasMany
    {
        return $this->hasMany(FollowUpVital::class, 'follow_up_id', 'id');
    }
}
