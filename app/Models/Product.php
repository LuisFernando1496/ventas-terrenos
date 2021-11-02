<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model{
    use HasFactory;

    protected $fillable =[
        'lote',
        'manzana',
        'calle',
        'dimenciones',
        'colonia',
        'numero_terreno',
        'price',
        'bar_code',
        'branch_office_id',
        'status'
    ];
    public function branch_office(){
        return $this->belongsTo(BranchOffice::class);
    }
}
