<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gastos
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
            class="font-semibold btn btn-outline-success  float-right">
            <i class="bi bi-pencil">Agregar un gasto</i>
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
                                <th>Uni. Negocio</th>
                                <th>Nombre del Gasto</th>
                                <th>Cantidad</th>
                                <th>Monto</th>
                                <th>Autorizado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($expenses as $expense)
                                <tr>
                                    <td>{{ $expense->id }}</td>
                                    <td>{{ $expense->bussinesUnit->name }}</td>
                                    <td>{{ $expense->name_expenditure }}</td>
                                    <td>{{ $expense->quantity }}</td>
                                    <td>${{ $expense->amount }}</td>
                                    <td>{{ $expense->user->name }}</td>
                                    <td>
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $expense->id }}"
                                            class="btn btn-outline-success">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{route('expenses.supr', $expense)}}" method="Post" class="d-inline" id="eliminar">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"  class="btn btn-outline-danger" >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $expense->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('expenses.update', $expense) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Gasto
                                                        {{ $expense->name_expenditure }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">nombre</label>
                                                                <input type="text" class="form-control" name="name_expenditure" value="{{$expense->name_expenditure}}" required> 
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Cantidad</label>
                                                                <input type="number" class="form-control" name="quantity" value="{{$expense->quantity}}" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Monto</label>
                                                                <input type="number" class="form-control" step="any" name="amount" value="{{$expense->amount}}" required> 
                                                            </div>
                                                        </div>
                                                    </div>
                
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
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
                            <form action="{{ route('expenses.store') }}" method="POST">
                                @csrf

                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Realizar Gasto</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                
                               
                                 <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Nombre del Gasto</label>
                                                <input type="text" class="form-control" name="name_expenditure" required> 
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Cantidad</label>
                                                <input type="number" class="form-control" name="quantity" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Monto</label>
                                                <input type="number" step="any" class="form-control" name="amount" placeholder="$" required> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Unidad de negocio</label>
                                                <select class="form-control" name="business_unit_id" id="" required>
                                                    <option value="0" selected disabled>Selecciona la unidad de negocio de este gasto</option>
                                                    @foreach ($unidades as $unidad)
                                                        <option value="{{$unidad->id}}">{{$unidad->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
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
