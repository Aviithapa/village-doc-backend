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

    const DAYS = [
        'SUNDAY','MONDAY','TUESDAY','WEDNESDAY','THURSDAY','FRIDAY','SATURDAY'
    ];

    const SHIFTS = [
        'MORNING','DAY','EVENING','NIGHT'
    ];

    protected $fillable = [
        'doctor_id','name','day_of_week','day_period','work_from','work_to','date'
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

}
