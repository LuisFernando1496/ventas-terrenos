<?php

namespace App\Http\Controllers;

use App\Models\BusinessUnit;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos = Project::where('status',true)->get();
        $managers = User::all();
        $unidades = BusinessUnit::where('status',true)->get();
        return view('projects.index',['proyectos'=>$proyectos,'managers'=>$managers,'unidades'=>$unidades]);
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

  
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $proyecto= Project::create($request->all());
            DB::commit();
            return redirect()->route('projects')->with('mensaje',"El proyecto $request->name se a Creado");
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        try {
            DB::beginTransaction();
            $project->update($request->all());
            DB::commit();
            return redirect()->route('projects')->with('mensaje',"El proyecto $request->name se a Actualizado");
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
        }
    }

   
    public function supr( Project $project){
        
        try {
            DB::beginTransaction();
            $project->update(
               [ 
                   'status'=> false
               ]
            );
            DB::commit();
            return redirect()->route('projects')->with('mensaje',"El proyecto $project->name se a Eliminado");
        } catch (\Error $th) {
            DB::rollBack();
            return $th;
        }

     }
    public function destroy(Project $project)
    {
        //
    }
}