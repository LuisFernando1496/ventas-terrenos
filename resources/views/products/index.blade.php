<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Productos
                </h2>
            </div>
            <div class="col">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-success">
                    <i class="bi bi-pencil">Crear producto</i>
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
                                <th>Precio</th>
                                <th>Codigo de barras</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productos as $producto)
                                <tr>
                                    <td>{{$producto->id}}</td>
                                    <td>{{$producto->name}}</td>
                                    <td>{{$producto->price}}</td>
                                    <td>{{$producto->bar_code}}</td>
                                    <td>{{$producto->status}}</td>
                                    <td>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$producto->id}}" class="btn btn-outline-success">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{$producto->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{route('productos.update',$producto)}}" method="POST">
                                                @csrf @method('PATCH')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar producto {{$producto->name}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Nombre</label>
                                                                <input type="text" class="form-control" name="name" value="{{ old('name',$producto->name) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Dirección</label>
                                                                <textarea name="address" id="" cols="30" rows="2" class="form-control">{{$producto->id}}</textarea>
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
                            <form action="{{route('productos.store')}}" method="POST">
                                @csrf
                                _token
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Crear Terreno</h5>
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
                                                <label for="">Precio</label>
                                                <input type="number" name="price" class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Codigo de barra</label>
                                                <input type="text" class="form-control" name="bar_code">
                                            </div>
                                        </div>
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
