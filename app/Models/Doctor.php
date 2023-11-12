<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes; // If you want to use soft deletes

    protected $fillable = [
        'salutation',
        'first_name',
        'last_name',
        'Specialization',
        'nmc_number',
        'gender',
        'contact_number',
        'emergency_contact_number',
        'hiring_date',
        'email',
        'address',
    ];
}
