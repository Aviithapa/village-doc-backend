<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pilccod extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'pallor',
        'icterus',
        'lyimphadenopathy',
        'clubbing',
        'dedema',
        'dehydration',
        'medical_record_id',
        'created_by',
        'updated_by'
    ];

    public function medicalRecords(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class, 'medical_record_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
