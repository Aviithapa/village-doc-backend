<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorSchedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    const DAY_SUNDAY = "SUNDAY";
    const DAY_MONDAY = "MONDAY";
    const DAY_TUESDAY = "TUESDAY";
    const DAY_WEDNESDAY = "WEDNESDAY";
    const DAY_THURSDAY = "THURSDAY";
    const DAY_FRIDAY = "FRIDAY";
    const DAY_SATURDAY = "SATURDAY";

    const DAYS = [
        self::DAY_SUNDAY,
        self::DAY_MONDAY,
        self::DAY_TUESDAY,
        self::DAY_WEDNESDAY,
        self::DAY_THURSDAY,
        self::DAY_FRIDAY,
        self::DAY_SATURDAY
    ];

    const SHIFT_MORNING = "MORNING";
    const SHIFT_DAY = "DAY";
    const SHIFT_EVENING = "EVENING";
    const SHIFT_NIGHT = "NIGHT";

    const SHIFTS = [
            self::SHIFT_MORNING,
            self::SHIFT_DAY,
            self::SHIFT_EVENING,
            self::SHIFT_NIGHT
    ];

    protected $fillable = [
        'doctor_id','name','day_of_week','day_period','work_from','work_to','date','created_by','updated_by'
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

}
