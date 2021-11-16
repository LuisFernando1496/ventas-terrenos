<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $project[0]->name }}

            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                class="font-semibold btn btn-outline-warning  float-right">
                <i class="bi bi-pencil">Cambiar estatus</i>
            </button>
        </h2>
    </x-slot>
    
    <br>
    <div class="float-right">
        <h3>Estatus: </h3>
        <button class="btn btn-outline-secondary "   data-bs-toggle="modal" data-bs-target="#progressModal">
            {{$project[0]->progress}}</button>
    </div>
<br>
    
    <div class="py-12">
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">       
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class="container">
                    <table class="table table-hover">
                        <thead>
                            <tr>

                                <th>Inversionista</th>
                                <th>Monto invertido</th>
                                <th>Fecha</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($project[0]->investor as $proyecto)
                                <tr>

                                    <td>{{ $proyecto->name }}</td>
                                    <td>${{ $proyecto->pivot->amount }}</td>
                                    <td>{{ $proyecto->pivot->created_at }}</td>

                                </tr>
                                <!-- Modal -->

                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <h1>Ventas</h1>
                    <table class="table table-hover">
                        <thead>
                            <tr>

                                <th>Codigo de barras</th>
                                <th>Colonia</th>
                                <th>Precio venta</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($project[0]->products as $product)
                                <tr>

                                    <td>{{ $product->bar_code }}</td>
                                    <td>{{ $product->colonia }}</td>
                                    <td>${{ $product->productInSales[0]->total }}</td>
                                    <td>{{ $product->productInSales[0]->created_at }}</td>
                                    <td>{{$project}}</td>

                                </tr>
                                <!-- Modal -->

                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('projects.progress', $project[0]->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Crear Proyecto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Comentario</label>
                                    <input type="text" class="form-control" name="progresss">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Estatus</label>
                                    <select class="form-control" name="status_progress" id="">
                                        <option value="0" selected disabled>Selecciona un encargado para esta proyecto
                                        </option>
                                        <option value="En-movimientos">En movimientos</option>
                                        <option value="Terminado">Terminado</option>
                                    </select>
                                </div>
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success"></button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div class="modal fade" id="progressModal" tabindex="-1" aria-labelledby="progressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('projects.progress', $project[0]->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-header">
                        <h5 class="modal-title" id="progressModalLabel">Lista de comnetarios</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>

                                    <th>Comentarios</th>
                                    <th>Fecha</th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($project[0]->projectProgress as $itemProgress)

                                    <tr>

                                        <td>{{ $itemProgress->progresss }}</td>
                                        <td>{{$itemProgress->created_at}}</td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>


</x-app-layout>
