<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Inversión
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
            class="font-semibold btn btn-outline-success  float-right">
            <i class="bi bi-pencil">Agregar Inversión</i>
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
                                <th>Cantidad y Destino de inversión</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($investors as $investor)
                                <tr>
                                    <td>{{$investor->id}}</td>
                                    <td>{{$investor->name}}</td>
                                    <td>
                                        @foreach ($investor->project as $item)
                                        $ {{$item->pivot->amount}} ----|----- {{$item->name}} <br/>
                                        @endforeach
                                    </td>

                                    <td>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$investor->id}}" class="btn btn-outline-success">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                       {{--  <form action="{{route('bussinesUnit.supr',$investor)}}" method="Post" class="d-inline" id="eliminar">
                                            @csrf
                                            @method('PATCH')
                                        <button type="submit"  class="btn btn-outline-danger" >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        </form>--}}
                                    </td>
                                </tr>
                                <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$investor->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{route('investors.update',$investor)}}" method="POST">
                                                @csrf @method('PATCH')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar usuario {{$investor->name}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                               <div class="modal-body">
                                                   <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Nombre</label>
                                                <input type="text" class="form-control" name="name" value="{{$investor->name}}">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Cantidad a invertir</label>
                                                <input type="text" class="form-control" name="amount">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <h3>Selecciona una opción</h3>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Proyectos</label>
                                                <select class="form-control" name="project_id" id="">
                                                    <option value="0" selected disabled>Selecciona una opción a invertir</option>
                                                    @foreach ($projects as $project)
                                                        <option value="{{$project->id}}">{{$project->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                      {{--  <div class="col">
                                            <div class="form-group">
                                                <label for="">Unidades de negocio</label>
                                                <select class="form-control" name="business_unit_id" id="">
                                                    <option value="0" selected disabled>Selecciona una opcion a invertir</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>--}}
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
                            <form action="{{route('investors.store')}}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Agregar Inversión</h5>
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
                                                <label for="">Cantidad a invertir</label>
                                                <input type="text" class="form-control" name="amount">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <h3>Selecciona una opción</h3>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Proyectos</label>
                                                <select class="form-control" name="project_id" id="">
                                                    <option value="0" selected disabled>Selecciona una opción a invertir</option>
                                                    @foreach ($projects as $project)
                                                        <option value="{{$project->id}}">{{$project->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Unidades de negocio</label>
                                                <select class="form-control" name="business_unit_id" id="">
                                                    <option value="0" selected disabled>Selecciona una opción a invertir</option>
                                                    @foreach ($units as $unit)
                                                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                                                    @endforeach
                                                </select>
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
