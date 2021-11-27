<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable =[
        'name_expenditure',
        'quantity',
        'amount',
        'business_unit_id',
        'user_id'
    ];

    public function bussinesUnit()
    {
        return $this->belongsTo(BusinessUnit::class,'business_unit_id');
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
