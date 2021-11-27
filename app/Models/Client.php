<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phonenumber',
        'rfc',
        'address_id',
        'user_add_id',
        'status'
    ];

    public function direccion(){
        return $this->hasOne(Address::class,'id','address_id');
    }

    public function agregado()
    {
        return $this->hasOne(User::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function expense()
    {
        return $this->hasmany(Expense::class);
    }
}
