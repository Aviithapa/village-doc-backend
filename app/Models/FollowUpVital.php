<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUpVital extends Model
{
    use HasFactory;
    protected $fillable = [
        'TPRBS',
        'value',
        'follow_up_id'
    ];
}
