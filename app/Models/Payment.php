<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = "payaments";
    protected $fillable = [
        'sale_id',
        'pay',
        'faltante',
        'status'
    ];

    public function venta()
    {
        return $this->belongsTo(Sale::class,'sale_id');
    }
}
