<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;
    protected $fillable = [
        'medical_record_id',
        'add_on_symptom',
        'condition',
        'medication',
        'reaction'
    ];
}
