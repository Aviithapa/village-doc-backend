<?php

namespace App\Models;

use App\Infrastructure\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Allergies extends Model
{
    use HasFactory,
        SoftDeletes,
        HasFilter;

    protected $fillable = [
        'patient_id',
        'allergen_name',
        'reaction'
    ];

    public function patient()
    {
        return $this->belongsTo(Patients::class, 'patient_id', 'id');
    }
}
