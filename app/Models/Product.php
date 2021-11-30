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
        'status',
        'project_id'
    ];
    public function branch_office(){
        return $this->belongsTo(BranchOffice::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id');
    }

    public function productInSales()
    {
        return $this->hasMany(ProductInSale::class);
    }

    public function productInPurchases()
    {
        return $this->hasMany(Purchase::class,'id','product_id');
    }
}
