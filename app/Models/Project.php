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
        'plano',
        'progress',
        'total_investment',
        'status',
        'manager_user_id',
        'business_unit_id',
    ];

    public function bussinesUnit()
    {
        return $this->belongsTo(BusinessUnit::class,'business_unit_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class,'manager_user_id');
    }

    public function products()//relacion inversa echa correctamente
    {
        return $this->hasMany(Product::class);
    }

    public function investor()
    {
        return $this->belongsToMany(Investor::class)->withPivot('amount','project_id','created_at')->withTimestamps();
    }

    public function projectProgress()
    {
        return $this->hasMany(ProjectProgress::class);
    }
    


}
