<?php

namespace App\Models\Province;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Municipality extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'district_id'
    ];

    public function district() : BelongsTo
    {
        return $this->belongsTo(District::class);
    }
}
