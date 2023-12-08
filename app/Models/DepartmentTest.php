<?php

namespace App\Models;

use App\Infrastructure\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentTest extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasFilter;

    protected $fillable =[
        'name','department_id'
    ];


    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class,'department_id','id');
    }

}
