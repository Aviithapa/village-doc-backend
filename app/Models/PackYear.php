<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackYear extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'medical_record_pack_year';
    
    protected $fillable = [
        'medical_record_id',
        'patient_id',
        'no_of_cigarettes',
        'pack_per_day',
        'duration',
    ];
}
