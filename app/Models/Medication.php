<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Medication extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'medication_name',
        'dosage',
        'quantity',
        'form',
        'route'
    ];

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Patients::class);
    }
}
