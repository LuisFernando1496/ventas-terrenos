<?php

namespace App\Http\Controllers;

use App\Models\BusinessUnit;
use App\Models\Investor;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investors = Investor::where('status',true)->with('project')->get();
        $units = BusinessUnit::where('status',true)->get();
        $projects = Project::where('status',true)->get();
       // return $investors;
        return view('investment.index',['investors'=>$investors,'units'=>$units,'projects'=>$projects]);
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
        $invercionBefore = Investor::where("name", "LIKE", "%{$request->name}%")->get();
        $project = Project::where('status',true)->where('id',$request->project_id)->first();
        if(count($invercionBefore)==0)
        {
            try {
                DB::beginTransaction();
                $investor= Investor::create($request->all());
                $investor->project()->attach($request->project_id,['amount'=>$request->amount]);
                $project->update([
                    'total_investment'=> $project->total_investment + $request->amount
                ]);
                DB::commit();
                return redirect()->route('investors')->with('mensaje',"Inversionista $request->name se a agregado");
            } catch (\Error $th) {
                DB::rollBack();
                return $th;
                } 
        }else{
            return redirect()->route('investors')->with('error',"Inversionista $request->name Ya existe");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function show(Investor $investor)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function edit(Investor $investor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investor $investor)
    {
       $project = Project::where('status',true)->where('id',$request->project_id)->first();
        try {
            DB::beginTransaction();
            $investor->update($request->all());
            $investor->project()->attach($request->project_id,['amount'=>$request->amount]);
             $project->update([
                    'total_investment'=> $project->total_investment + $request->amount
                ]);
            DB::commit();
            return redirect()->route('investors')->with('mensaje',"Monto agregado");
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
            } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investor $investor)
    {
        //
    }
}
