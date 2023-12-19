<?php

namespace App\Models;

use App\Infrastructure\Traits\HasFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use HasFactory;
    use SoftDeletes;
    use HasFilter;
    
    protected $fillable = [
        'name'
    ];

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
}
