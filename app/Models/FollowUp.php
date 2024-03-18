<?php

namespace App\Models;

use App\Infrastructure\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory, HasFilter;
    protected $fillable = [
        'medical_record_id',
        'add_on_symptom',
        'condition',
        'medication',
        'reaction'
    ];
}
