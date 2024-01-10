<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medication extends Model
{
    use HasFactory;
    use SoftDeletes;

    const FORM_TABLET = 'TABLET';
    const FORM_CAPSULE = 'CAPSULE';
    const FORM_LIQUID = 'LIQUID';

    const FORM = [
        self::FORM_TABLET,
        self::FORM_CAPSULE,
        self::FORM_LIQUID
    ];

    const ROUTE_ORAL = 'ORAL';
    const ROUTE_INTRAVENOUS = 'INTRAVENOUS';
    const ROUTE_TROPICAL = 'TROPICAL';

    const ROUTE = [
        self::ROUTE_ORAL,
        self::ROUTE_INTRAVENOUS,
        self::ROUTE_TROPICAL
    ];


    protected $fillable = [
        'medical_record_id',
        'medication_name',
        'dosage',
        'quantity',
        'form',
        'route',
        'created_by',
        'updated_by'
    ];

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Patients::class);
    }

    public function MedicalRecord(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id', 'id');
    }
}
