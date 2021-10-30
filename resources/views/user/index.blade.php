<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Usuarios
                </h2>
            </div>
            <div class="col">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-success">
                    <i class="bi bi-pencil">Crear Usuario</i>
                </button>
            </div>
        </div>
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
                                    <td>{{$user->office->name}}</td>
                                    <td>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$user->id}}" class="btn btn-outline-success">
                                            <i class="bi bi-pencil"></i>
                                        </button>
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
                                                <label for="">Password</label>
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


