<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = Purchase::with('product')->get();
        $products = Product::where('status',true)->get();
        return view('purchases.index',[
            'purchases' => $purchases,
            'products' => $products
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
        //return $request;
        $product = $request['product_id'];
        if($product == "nuevo")
        {
            $producto = new Request();
            $producto['bar_code'] = $request['bar_code'];
            $producto['lote'] = $request['lote'];
            $producto['manzana'] = $request['manzana'];
            $producto['calle'] = $request['calle'];
            $producto['dimenciones'] = $request['dimenciones'];
            $producto['colonia'] = $request['colonia'];
            $producto['numero_terreno'] = $request['numero_terreno'];
            $producto['price'] = $request['price'];
            try {
                DB::beginTransaction();
                $products = new Product($producto->all());
                $products->save();
                $purchase = new Purchase();
                $purchase->title = $request->title;
                $purchase->description = $request->description;
                $purchase->quantity = $request->quantity;
                $purchase->product_id = $products->id;
                $purchase->price = $request->price;
                $purchase->total = $request->total;
                $purchase->save();
                DB::commit();
                return redirect()->route('purchase');
            } catch (\Error $th) {
                return $th;
            }


        }
        else if($product == "otro")
        {
            try {
                DB::beginTransaction();
                $purchase = new Purchase();
                $purchase->title = $request->title;
                $purchase->description = $request->description;
                $purchase->quantity = $request->quantity;
                $purchase->price = $request->price;
                $purchase->total = $request->total;
                $purchase->save();
                DB::commit();
                return redirect()->route('purchase');
            } catch (\Error $th) {
                return $th;
            }
        }
        else
        {
            try {
                DB::beginTransaction();
                $purchase = new Purchase();
                $purchase->title = $request->title;
                $purchase->description = $request->description;
                $purchase->quantity = $request->quantity;
                $purchase->product_id = $request->product_id;
                $purchase->price = $request->price;
                $purchase->total = $request->total;
                $purchase->save();
                DB::commit();
                return redirect()->route('purchase');
            } catch (\Error $th) {
                return $th;
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
