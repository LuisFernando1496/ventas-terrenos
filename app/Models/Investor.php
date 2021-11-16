<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    public function project()
    {
        return $this->belongsToMany(Project::class)->withPivot('amount','project_id','created_at')->withTimestamps();
    }
}
