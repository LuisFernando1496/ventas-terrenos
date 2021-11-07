<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
   
    public function index()
    {
        $clients = Client::where('status',true)->get();
        return view('sale.index',['clients'=>$clients]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Sale $sale)
    {
        //
    }

   
    public function edit(Sale $sale)
    {
        //
    }

  
    public function update(Request $request, Sale $sale)
    {
        //
    }

    public function search(Request $request)
    {
        $product = Product::where("products.name", "LIKE", "%{$request->search}%")->get();

        if ($product->pluck('category_id')->first() == 1) {
            $datas = Product::join('categories', 'products.category_id', 'categories.id')
                ->where("products.name", "LIKE", "%{$request->search}%")
                ->where("products.stock", ">", 0)->where("products.status", "=", true)
                ->select('products.*', 'categories.name as category_name', 'categories.id as category_id')
                ->get();
        } else {
            $datas = Product::join('brands', 'products.brand_id', 'brands.id')
                ->join('categories', 'products.category_id', 'categories.id')
                ->where("products.name", "LIKE", "%{$request->search}%")
                ->where("products.stock", ">", 0)->where("products.status", "=", true)
                ->where('products.branch_office_id', Auth::user()->branch_office_id)
                ->orWhere("brands.name", "LIKE", "%{$request->search}%")
                ->select('products.*', 'brands.name as brand_name', 'brands.id as brand_id', 'categories.name as category_name', 'categories.id as category_id')
                ->get();
        }
        return response()->json($datas);
    }

    public function searchByCode(Request $request)
    {
        $datas = Product::join('projects','products.project_id','projects.id')
                 ->join('business_units','projects.business_unit_id','business_units.id')
                 ->where("products.status", "=", true)
                 ->where('products.bar_code',$request->search)
                 ->select('products.*', 'products.bar_code as codigo', 
                          'products.colonia as colonia', 
                          'products.numero_terreno as terreno', 
                          'products.lote as lote', 
                          'products.manzana as manzana', 
                          'products.dimenciones as dimenciones', 
                          'products.price as precio', 
                          'projects.name as proyecto',
                          'business_units.name as unidad'
                          )
                 ->get();

        return response()->json($datas);
    }


    
    public function destroy(Sale $sale)
    {
        //
    }
}
