<?php

namespace App\Models\Province;

use App\Models\Patients;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Province extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'status'
    ];

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patients::class);
    }
}
