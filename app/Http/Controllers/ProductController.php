<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\BranchOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Product::where('status',1)->get();
        $offices = BranchOffice::all();
        return view('products.index',[
            'productos' => $productos,
            'officess' => $offices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $producto = Product::create($request->all());
            DB::commit();
            return redirect()->route('productos');
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $product->update($request->all());
            DB::commit();
            return redirect()->route('productos')->with('mensaje',"El terreno $request->bar_code se a actualizado");
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

     public function supr(Request $request, Product $product){
        
        try {
            DB::beginTransaction();
            $product->update(
               [ 
                   'status'=> false
               ]
            );
            DB::commit();
            return redirect()->route('productos')->with('mensaje',"El terreno $product->bar_code se a Eliminado");
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
        }

     }
    public function destroy(Product $product)
    {
        //
    }
}
