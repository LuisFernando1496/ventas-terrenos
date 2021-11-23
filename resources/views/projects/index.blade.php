<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Proyectos
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
            class="font-semibold btn btn-outline-success  float-right">
            <i class="bi bi-pencil">Crear proyecto</i>
        </button>
         </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripcion</th>
                                <th>Estatus</th>
                                <th>Encargado</th>
                                <th>Unidad de negocio</th>
                                <th>Total de inversion</th>
                                <th>Plano</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($proyectos as $proyecto)
                                <tr>
                                    <td>{{$proyecto->id}}</td>
                                    <td>{{$proyecto->name}}</td>
                                    <td>{{$proyecto->description}}</td>
                                    <td>{{$proyecto->progress}}</td>
                                     <td> @if($proyecto->manager_user_id === null)
                                        No asignado
                                        @else
                                        {{$proyecto->manager->name}}
                                        @endif 
                                     </td>
                                     <td>  {{$proyecto->bussinesUnit->name}}  </td>
                                     <td>${{$proyecto->total_investment}}</td>
                                     <td>
                                         <button type="button" data-bs-toggle="modal" data-bs-target="#imgModal{{$proyecto->id}}" class="btn btn-outline-success">
                                        Ver plano</button>
                                    </td>
                                    <td>
                                        <a href="{{route('projects.show',$proyecto)}}" class="btn btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$proyecto->id}}" class="btn btn-outline-success">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{route('bussinesUnit.supr',$proyecto)}}" method="Post" class="d-inline" id="eliminar">
                                            @csrf
                                            @method('PATCH')
                                        <button type="submit"  class="btn btn-outline-danger" >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="imgModal{{$proyecto->id}}" tabindex="-1" aria-labelledby="imgModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="#" method="POST">
                                               
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="imgModalLabel">Plano {{$proyecto->name}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                               <div class="modal-body">
                                                    
                                               <img src="{{asset($proyecto->plano)}}" alt="plano">
                                                
                                                </div>
                                                   
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                                <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$proyecto->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{route('projects.update',$proyecto)}}" method="POST" enctype="multipart/form-data">
                                                @csrf @method('PATCH')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar usuario {{$proyecto->name}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                               <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Nombre</label>
                                                                <input type="text" class="form-control" name="name" value="{{$proyecto->name}}">
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Descripcion</label>
                                                                <textarea type="text" class="form-control"cols="1" rows="0.5" name="description">{{$proyecto->description}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Inserta nueva imagen del plano</label>
                                                                <input type="file" class="form-control" name="img_plano">
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Encargado</label>
                                                                <select class="form-control" name="manager_user_id" id="">
                                                                    <option value="{{$proyecto->manager_user_id}}" >{{$proyecto->manager->name}}</option>
                                                                    @foreach ($managers as $manager)
                                                                        <option value="{{$manager->id}}">{{$manager->name}}--{{$manager->role[0]->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Unidad de negocio</label>
                                                                <select class="form-control" name="business_unit_id" id="" required>
                                                                    <option value="{{$proyecto->business_unit_id}}" >{{$proyecto->bussinesUnit->name}}</option>
                                                                   
                                                                    @foreach ($unidades as $unidad)
                                                                        <option value="{{$unidad->id}}">{{$unidad->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    
                                                    </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                           
                               
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{route('projects.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Crear Proyecto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Nombre</label>
                                                <input type="text" class="form-control" name="name">
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Descripcion</label>
                                                <textarea type="text" class="form-control"cols="1" rows="0.5" name="description"></textarea>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Inserta la imagen del plano</label>
                                                <input type="file" class="form-control" name="img_plano">
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Encargado</label>
                                                <select class="form-control" name="manager_user_id" id="">
                                                    <option value="0" selected disabled>Selecciona un encargado para esta proyecto</option>
                                                    @foreach ($managers as $manager)
                                                        <option value="{{$manager->id}}">{{$manager->name}}--{{$manager->role[0]->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Unidad de negocio</label>
                                                <select class="form-control" name="business_unit_id" id="" required>
                                                    <option value="0" selected disabled>Selecciona la unidad de negocio de este proyecto</option>
                                                    @foreach ($unidades as $unidad)
                                                        <option value="{{$unidad->id}}">{{$unidad->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                     
                                    </div>
                                   
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Crear</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
              
   
</x-app-layout>


