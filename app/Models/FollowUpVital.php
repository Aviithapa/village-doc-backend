<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FollowUpVital extends Model
{
    use HasFactory;

    protected $fillable = [
        'blood_pressure',
        'pulse',
        'temperature',
        'respiration',
        'saturation',
        'follow_up_id'
    ];

    public function follow_up(): BelongsTo
    {
        return $this->belongsTo(FollowUp::class, 'follow_up_id', 'id');
    }
}
