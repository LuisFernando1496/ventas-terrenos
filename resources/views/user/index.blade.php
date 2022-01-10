<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Usuarios
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
            class="font-semibold btn btn-outline-success  float-right">
            <i class="bi bi-pencil">Crear Usuarios</i>
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
                                <th>Correo</th>
                                <th>Dirección</th>
                                <th>Puesto</th>
                                <th>Oficina</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->address}}</td>
                                   <td> @foreach ($user->role as $rol)
                                        {{$rol->name}}
                                    @endforeach
                                    </td>
                                    <td>{{$user->office->name}}</td>
                                    <td>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}" class="btn btn-outline-success">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="" method="Post" class="d-inline" id="eliminar">
                                            @csrf
                                            @method('Delete')
                                        <button type="button"  class="btn btn-outline-danger" >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        </form>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{route('users.update',$user)}}" method="POST">
                                                @csrf @method('PATCH')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar usuario {{$user->name}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Nombre</label>
                                                                <input type="text" class="form-control" name="name" value="{{ old('name',$user->name) }}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Correo</label>
                                                                <input type="text" class="form-control" readonly name="email" value="{{ old('email',$user->email) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Dirección</label>
                                                                <textarea name="address" id="" cols="30" rows="2" class="form-control">{{$user->address}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Oficina</label>
                                                                <select name="branch_office_id" id="" class="form-control">
                                                                    @forelse ($officess as $office)
                                                                        @if ($office->id == $user->office->id)
                                                                            <option value="{{$office->id}}" selected>{{$office->name}}</option>
                                                                        @else
                                                                            <option value="{{$office->id}}">{{$office->name}}</option>
                                                                        @endif

                                                                    @empty

                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
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
                            <form action="{{route('users.store')}}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
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
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Correo</label>
                                                <input type="text" class="form-control" name="email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Contraseña</label>
                                                <input type="password" name="password" id="password" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Dirección</label>
                                                <textarea name="address" id="" cols="30" rows="2" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Puesto</label>
                                                <select name="role_id" id="" class="form-control">
                                                    <option value="0" selected disabled>Selecciona un puesto para el usuario</option>
                                                    @forelse ($puestos as $puesto)
                                                        <option value="{{$puesto->id}}">{{$puesto->name}}</option>
                                                    @empty

                                                    @endforelse
                                                </select>
                                            </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Oficina</label>
                                                <select name="branch_office_id" id="" class="form-control">
                                                    @forelse ($officess as $office)
                                                        <option value="{{$office->id}}">{{$office->name}}</option>
                                                    @empty

                                                    @endforelse
                                                </select>
                                            </div>
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


