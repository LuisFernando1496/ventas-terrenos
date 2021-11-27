<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectProgress extends Model
{
    use HasFactory;
    protected $table = 'project_progress';
    protected $fillable = [
        'project_id',
        'progresss',
        'file_progress'
    ];
}
