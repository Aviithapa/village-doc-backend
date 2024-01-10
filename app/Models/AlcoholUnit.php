<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlcoholUnit extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "medical_record_unit_week";

    protected $fillable = [
        'medical_record_id',
        'patient_id',
        'percentage_of_alcohol',
        'percentage_per_day',
        'volume_consumed',
        'days_count',
        'volume_consumed_per_week',
    ];
}
