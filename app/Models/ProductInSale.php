<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInSale extends Model
{
    use HasFactory;
    protected $table = 'product_in_sales';
    protected $fillable = [
        'product_id',
        'sale_id' ,
         'quantity',
        'subtotal',
        'sale_price',
        'total',
        'total_cost',
         'discount',
    ];
    public function sale(){
        return $this->belongsTo(Sale::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
