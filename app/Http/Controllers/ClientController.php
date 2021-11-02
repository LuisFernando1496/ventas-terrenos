<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::where('status',true)->get();
        return view('clients.index',['clientes'=>$clients]);
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
            $direccion = Address::create($request->all());
            $request['address_id']=$direccion->id;
            $request['user_add_id']=auth()->user()->id;
            $client = Client::create($request->all());
            DB::commit();
            return redirect()->route('clientes')->with('mensaje',"El Cliente $request->name se a Creado");
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        try {
            DB::beginTransaction();
            $address = Address::where('id',$request->address_id);
            $address->update([
                'colonia'=>$request->colonia,
                'calle'=>$request->calle,
                'ciudad'=>$request->ciudad,
                'estado'=>$request->estado,
                'numero_int'=>$request->numero_int,
                'numero_ext'=>$request->numero_ext,
            ]);
            $client->update([
                'name'=> $request->name,
                'last_name'=> $request->last_name,
                'email'=> $request->email,
                'phonenumber'=> $request->phonenumber,
                'rfc'=> $request->rfc,
            ]);
            DB::commit();
            return redirect()->route('clients')->with('mensaje',"El Cliente $request->name se a actualizado");
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */

    public function supr(Client $client){
        
        try {
            DB::beginTransaction();
            $client->update(
               [ 
                   'status'=> false
               ]
            );
            DB::commit();
            return redirect()->route('clients')->with('mensaje',"El Cliente $client->name se a Eliminado");
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
        }

     }
    public function destroy(Client $client)
    {
        //
    }
}
