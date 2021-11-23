<?php

namespace App\Http\Controllers;

use App\Models\BusinessUnit;
use App\Models\Project;
use App\Models\ProjectProgress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        
        $imagenNombre = $request->img_plano->getClientOriginalName();
        $imagen = $request->file('img_plano');
        Storage::disk('public')->put("imgPlanos/$imagenNombre",  file($imagen));
        $imagen= Storage::url("imgPlanos/$imagenNombre");
        try {
            DB::beginTransaction();
            $request['plano'] = $imagen;
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
      
        $proyecto = $project::where('status',true)
        ->where('id',$project->id)
        ->with('investor','products.productInSales','projectProgress')->get();
       // return $proyecto[0]->products;
        return view('projects.ditails',['project'=>$proyecto]); 
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

   public function progress(Request $request, Project $project)
   {
       //return $project->progress;
      
       try {
                DB::beginTransaction();
            $progres = ProjectProgress::create([
                'project_id'=> $project->id,
                'progresss'=>$request->progresss
            ]);
            $proyecto = Project::find($project->id);
            $proyecto->update([
                'progress'=>$request->status_progress
     ]);
     DB::commit();
     return redirect()->route('projects')->with('mensaje',"El estatus de proyecto $project->name se a Actualizado");
    } catch (\Error $th) {
        DB::rollBack();
        return $th;
    }
    }

    public function update(Request $request, Project $project)
    {
        if($request->img_plano)
        {
           
            $url = str_replace('storage','public',$project->plano);
            Storage::delete($url);
            $imagenNombre = $request->img_plano->getClientOriginalName();
            $imagen = $request->file('img_plano');
            Storage::disk('public')->put("imgPlanos/$imagenNombre",  file($imagen));
            $imagen= Storage::url("imgPlanos/$imagenNombre");
        }
        else {
            $imagen = $project->plano;
        }
        try {
            DB::beginTransaction();
            $request['plano'] = $imagen;
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
