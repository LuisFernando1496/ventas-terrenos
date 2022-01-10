<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Productos
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
            class="font-semibold btn btn-outline-success  float-right">
            <i class="bi bi-pencil">Crear Productos</i>
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
                                <th>Lote</th>
                                <th>Manzana</th>
                                <th>Calle</th>
                                <th>Colonia</th>
                                <th>Dimenciones(M<sup>2</sup>)</th>
                                <th>No. terreno</th>
                                <th>Precio</th>
                                <th>Proyecto</th>
                                <th>U. Negocio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productos as $producto)
                                <tr>

                                    <td>{{ $producto->bar_code }}</td>
                                    <td>{{ $producto->lote}}</td>
                                    <td>{{ $producto->manzana }}</td>
                                    <td>{{ $producto->calle }}</td>
                                    <td>{{ $producto->colonia }}</td>
                                    <td>{{ $producto->dimenciones }}</td>
                                    <td>{{ $producto->numero_terreno }}</td>
                                    <td>$ {{ $producto->price }}</td>
                                    <td>{{ $producto->project->name ?? "" }}</td>
                                    <td>{{ $producto->project->bussinesUnit->name }}</td>
                                    <td>
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $producto->id }}"
                                            class="btn btn-outline-success">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{route('productos.supr',$producto)}}" method="Post" class="d-inline" id="eliminar">
                                            @csrf
                                             @method('PATCH')
                                        <button type="submit"  class="btn btn-outline-danger" >
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        </form>

                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $producto->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('productos.update', $producto) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar producto
                                                        {{ $producto->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">ID Producto</label>
                                                                <input type="text" class="form-control" name="bar_code" value="{{$producto->bar_code}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Lote</label>
                                                                <input type="text" class="form-control" name="lote" value="{{$producto->lote}}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Manzana</label>
                                                                <input type="text" class="form-control" name="manzana" value="{{$producto->manzana}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Calle</label>
                                                                <input type="text" class="form-control" name="calle" value="{{$producto->calle}}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Dimenciones(M<sup>2</sup>)</label>
                                                                <input type="text" class="form-control" name="dimenciones" value="{{$producto->dimenciones}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Colonia</label>
                                                                <input type="text" class="form-control" name="colonia" value="{{$producto->colonia}}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Número de terreno</label>
                                                                <input type="text" class="form-control" name="numero_terreno" value="{{$producto->numero_terreno}}" required>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Precio</label>
                                                                <input type="number" step="any" name="price" class="form-control" value="{{$producto->price}}" id="" required>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label for="">Oficina</label>
                                                            <select name="branch_office_id" id="" class="form-control" required>
                                                                <option value="{{$producto->branch_office_id}}">{{$producto->branch_office->name}}</option>
                                                                @forelse ($officess as $office)
                                                                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                                                                @empty

                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="form-group">
                                                            <label for="">Proyecto</label>
                                                            <select name="project_id" id="" class="form-control" required>
                                                                <option value="{{ $producto->project_id }}" >{{ $producto->project_id }}</option>
                                                         @forelse ($proyectos as $proyecto)
                                                                    <option value="{{ $proyecto->id }}">{{ $proyecto->name }}</option>
                                                                @empty

                                                                @endforelse
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Actualizar</button>
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
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('productos.store') }}" method="POST">
                                @csrf

                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Crear Producto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>


                                 <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">ID</label>
                                                <input type="text" class="form-control" name="bar_code" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Lote</label>
                                                <input type="text" class="form-control" name="lote" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Manzana</label>
                                                <input type="text" class="form-control" name="manzana" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Calle</label>
                                                <input type="text" class="form-control" name="calle" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Dimenciones(M<sup>2</sup>)</label>
                                                <input type="text" class="form-control" name="dimenciones" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Colonia</label>
                                                <input type="text" class="form-control" name="colonia" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Número de terreno</label>
                                                <input type="text" class="form-control" name="numero_terreno" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Precio</label>
                                                <input type="number" step="any" name="price" class="form-control" id="" required>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Oficina</label>
                                            <select name="branch_office_id" id="" class="form-control" required>
                                                @forelse ($officess as $office)
                                                    <option value="{{ $office->id }}">{{ $office->name }}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group">
                                            <label for="">Proyecto</label>
                                            <select name="project_id" id="" class="form-control" required>
                                                <option value="0" selected disabled>Seleciona el proyecto al que pertenece</option>
                                                @forelse ($proyectos as $proyecto)
                                                    <option value="{{ $proyecto->id }}">{{ $proyecto->name }}</option>
                                                @empty

                                                @endforelse
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
