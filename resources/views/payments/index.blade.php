<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Compras
            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
            class="font-semibold btn btn-outline-success  float-right">
            <i class="bi bi-pencil">Nueva Compra</i>
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
                                <th>Folio Venta</th>
                                <th>Total Venta</th>
                                <th>Adeudo</th>
                                <th>Abonos</th>
                                <th>Cliente</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Modal
                            @forelse ($payments as $pay)
                                @if ($pay->status == true)
                                    <tr>
                                @else
                                    <tr class="table-danger">
                                @endif
                                    <td>{{ $pay->id }}</td>
                                    <td>{{ $pay->title }}</td>
                                    <td>{{ $pay->description }}</td>
                                    <td>{{ $pay->product->bar_code ?? "" }}</td>
                                    <td>{{ $pay->price }}</td>
                                    <td>{{ $pay->quantity }}</td>
                                    <td>{{ $pay->total}}</td>
                                    <td>
                                        @if ($pay->status == true)
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $pay->id }}"
                                            class="btn btn-outline-success">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{route('purchase.delete',$pay)}}" method="Post" class="d-inline" id="eliminar">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"  class="btn btn-outline-danger" >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                        @else
                                            Cancelado
                                        @endif


                                    </td>
                                </tr>

                            <div class="modal fade" id="exampleModal{{ $pay->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('purchase.update', $pay) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Compra
                                                        "{{ $pay->title }}"</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Título</label>
                                                                <input type="text" class="form-control" name="title" required value="{{old('title',$pay->title)}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Descripción</label>
                                                                <textarea name="description" class="form-control" id="description" cols="30" rows="1">{{$pay->description}}</textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Producto</label>
                                                                <input type="text" readonly name="product_id" value="{{$pay->product->bar_code ?? "" }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Cantidad</label>
                                                                <input type="number" step="any" class="form-control cantidad" data-id="{{$pay->id}}" id="cantidad{{$pay->id}}" name="quantity" required value="{{old('quantity',$pay->quantity)}}">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Precio</label>
                                                                <input type="number" step="any" class="form-control" name="price" id="price{{$pay->id}}" required readonly value="{{old('price',$pay->price)}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Total</label>
                                                                <input type="number" step="any" class="form-control" id="total{{$pay->id}}" name="total" required readonly value="{{old('total',$pay->total)}}">
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
                             -->
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#producto-nuevo').hide();
            $('#product').on('change',function(){
                var valor = $(this).children(':selected').val();
                if(valor == "nuevo")
                {
                    $('#producto-nuevo').show();
                    $('#precio_normal').hide();
                    $('#precio').val(0);
                    $('#price').val("");
                    $('#price').attr('required',false);
                    total();
                }
                else if(valor == "otro")
                {
                    $('#producto-nuevo').hide();
                    $('#precio_normal').show();
                    $('#precio').val("");
                    $('#precio').attr('required',false);
                    $('#bar_code').attr('required',false);
                    $('#lote').attr('required',false);
                    $('#manzana').attr('required',false);
                    $('#numero_terreno').attr('required',false);
                    $('#calle').attr('required',false);
                    $('#dimensiones').attr('required',false);
                    $('#colonia').attr('required',false);
                    $('#price').val(0);
                    $('#price').attr('required',true);
                    total();

                }
                else if(valor == "")
                {
                    $('#producto-nuevo').hide();
                    $('#precio_normal').show();
                    $('#precio').val("");
                    $('#precio').attr('required',false);
                    $('#bar_code').attr('required',false);
                    $('#lote').attr('required',false);
                    $('#manzana').attr('required',false);
                    $('#calle').attr('required',false);
                    $('#numero_terreno').attr('required',false);
                    $('#dimensiones').attr('required',false);
                    $('#colonia').attr('required',false);
                    $('#price').val(0);
                    $('#price').attr('required',true);
                    total();
                }
                else
                {
                    $('#producto-nuevo').hide();
                    $('#precio_normal').show();
                    $('#precio').val("");
                    $('#precio').attr('required',false);
                    $('#bar_code').attr('required',false);
                    $('#lote').attr('required',false);
                    $('#manzana').attr('required',false);
                    $('#calle').attr('required',false);
                    $('#numero_terreno').attr('required',false);
                    $('#dimensiones').attr('required',false);
                    $('#colonia').attr('required',false);
                    $('#price').val(0);
                    $('#price').attr('required',true);
                    $.get('productos-ajax/'+valor,function(data) {
                        console.log(data);
                        $('#price').val(data['price']);
                        total();
                    });

                }
            });
            total();

            $('#cantidad').on('change',function(){
                total();
            });

            $('.cantidad').on('change',function(){
                var id = $(this).data('id');
                var precio = $('#price'+id).val();
                var cantidad = $('#cantidad'+id).val();
                var total = precio * cantidad;
                $('#total'+id).val(total);

            });

            function total() {
                var cantidad = $('#cantidad').val();
                var precio = $('#precio').val();
                var price = $('#price').val();
                var total = 0;
                if(precio != 0)
                {
                    total = cantidad * precio;
                }
                else{
                    total = cantidad * price;
                }

                $('#total').val(total);
            }


        });
    </script>
</x-app-layout>
