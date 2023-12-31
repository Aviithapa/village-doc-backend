<?php

namespace App\Models;

use App\Infrastructure\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes, HasFilter; // If you want to use soft deletes

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
        'created_by',
        'updated_by'
    ];

    public function signature() : HasOne
    {
        return $this->hasOne(Medias::class,'doctor_id','id');
    }
}
