<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessUnit extends Model
{
    use HasFactory;
    protected $fillable = [
        'photo',
        'name',
        'description',
        'address_id',
        'status',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class,'project_id');
    }
}
