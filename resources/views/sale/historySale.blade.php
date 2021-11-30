<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Historial de ventas
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID. Venta</th>
                                <th>Productos</th>
                                <th>Empleado</th>
                                <th>Subtotal</th>
                                <th>Descuento</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sales as $sale)
                                <tr>
                                    <td>{{$sale->id}}</td>
                                    <td>
                                    @forelse ($sale->productsInSale as $product)
                                        {{$product->product->bar_code}} - {{$product->product->project->name}} - {{$product->product->project->bussinesUnit->name}}
                                    @empty
                                        Sin productos
                                    @endforelse
                                    </td>
                                    <td>{{$sale->user->name}}</td>
                                    <td>$ {{$sale->cart_subtotal}}</td>
                                    <td>{{$sale->amount_discount}}</td>
                                    <td>$ {{$sale->cart_total}}</td>
                                    <td>
                                        <form action="{{route('reprint')}}" class="d-inline" method="POST">
                                            <input type="hidden" name="sale_id" value="{{$sale->id}}">
                                        <button  type="submit" class="btn btn-outline-success">
                                            <i class="bi bi-printer"></i> Ticket
                                        </button>
                                    </form>
                                        <a href="" type="button" class="btn btn-outline-danger">
                                            <i class="bi bi-x-octagon"></i> Cancelar venta
                                        </a>
                                    </td>
                                </tr>
                                <!-- Modal -->
                             {{--    <div class="modal fade" id="exampleModal{{$sucursal->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{route('sucursales.update',$sucursal)}}" method="POST">
                                                @csrf @method('PATCH')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar usuario {{$sucursal->name}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Nombre</label>
                                                                <input type="text" class="form-control" name="name" value="{{ old('name',$sucursal->name) }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Dirección</label>
                                                                <textarea name="address" id="" cols="30" rows="2" class="form-control">{{$sucursal->address}}</textarea>
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
                                </div>--}}
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
              {{--  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{route('sucursales.store')}}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Crear Sucursal</h5>
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
                                                <label for="">Avenida</label>
                                                <input type="text" name="street" class="form-control" id="">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Colonia</label>
                                                <input type="text" class="form-control" name="suburb">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">CP</label>
                                                <input type="number" name="postal_code" id="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Nº Exterior</label>
                                                <input type="number" name="ext_number" id="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Nº Interior</label>
                                                <input type="number" class="form-control" name="int_number" id="">
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
                </div> --}}
            </div>
        </div>
    </div>
</x-app-layout>
