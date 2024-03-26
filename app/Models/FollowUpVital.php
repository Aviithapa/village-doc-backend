<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FollowUpVital extends Model
{
    use HasFactory;
    const TPRBS_BP = 'BLOOD-PRESSURE';
    const TPRBS__PULSE = 'PULSE';
    const TPRBS_TEMP = 'TEMPERATURE-°F';
    const TPRBS_RESPIRATION = 'RESPIRATION';
    const TPRBS_SP02 = 'SPO2';


    const TPRBS = [
        self::TPRBS_BP,
        self::TPRBS__PULSE,
        self::TPRBS_TEMP,
        self::TPRBS_RESPIRATION,
        self::TPRBS_SP02,
    ];
    protected $fillable = [
        'TPRBS',
        'value',
        'follow_up_id'
    ];

    public function follow_up(): BelongsTo
    {
        return $this->belongsTo(FollowUp::class, 'follow_up_id', 'id');
    }
}
