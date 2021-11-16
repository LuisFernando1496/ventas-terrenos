<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Sale extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_type',
        'status',
        'amount_discount',
        'discount',
        'cart_subtotal',
        'cart_total',
        'turned',
        'ingress',
        'total_cost',
        'status_credit',
        'branch_office_id',
        'user_id',
        'client_id',
    ];
    public function productsInSale(){
        return $this->hasMany(ProductInSale::class);
    }
    public function branchOffice(){
        return $this->belongsTo(BranchOffice::class);
    }
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function abonos()
    {
        return $this->hasMany(Payment::class,'id','sale_id');
    }

}
