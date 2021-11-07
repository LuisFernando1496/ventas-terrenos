<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'progress',
        'status',
        'manager_user_id',
        'business_unit_id',
    ];

    public function bussinesUnit()
    {
        return $this->belongsTo(bussinesUnit::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class);
    }

}
