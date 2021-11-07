<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'price',
        'quantity',
        'product_id',
        'status',
        'total'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
