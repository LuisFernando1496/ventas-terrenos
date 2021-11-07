<?php

namespace App\Http\Controllers;

use App\Models\BusinessUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BusinessUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = BusinessUnit::where('status',true)->get();
        return view('businesUnits.index',['business'=>$units]);
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
      
            // 'photo'
   
    
        try {
            DB::beginTransaction();
            $imagenNombre = $request->imagen->getClientOriginalName();
            $imagen = $request->file('imagen');
            Storage::disk('public')->put("imagenUnits/$imagenNombre",  file($imagen));
            $imagen= Storage::url("imagenUnits/$imagenNombre");
            $request['photo'] = $imagen;
            $units = BusinessUnit::create($request->all());
         DB::commit();
            return redirect()->route('bussinesUnit')->with('mensaje',"La unidad de negocio $request->name se a Creado");
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessUnit  $businessUnit
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessUnit $businessUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessUnit  $businessUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessUnit $businessUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BusinessUnit  $businessUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BusinessUnit $businessUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessUnit  $businessUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessUnit $businessUnit)
    {
        //
    }
}
