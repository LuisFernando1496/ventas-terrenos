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
                                <th>Folio</th>
                                <th>Titulo</th>
                                <th>Descripción</th>
                                <th>Producto</th>
                                <th>Costo</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($purchases as $purchase)
                                @if ($purchase->status == true)
                                    <tr>
                                @else
                                    <tr class="table-danger">
                                @endif
                                    <td>{{ $purchase->id }}</td>
                                    <td>{{ $purchase->title }}</td>
                                    <td>{{ $purchase->description }}</td>
                                    <td>{{ $purchase->product->bar_code ?? "" }}</td>
                                    <td>{{ $purchase->price }}</td>
                                    <td>{{ $purchase->quantity }}</td>
                                    <td>{{ $purchase->total}}</td>
                                    <td>
                                        @if ($purchase->status == true)
                                        <button type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $purchase->id }}"
                                            class="btn btn-outline-success">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <form action="{{route('purchase.delete',$purchase)}}" method="Post" class="d-inline" id="eliminar">
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
                                <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $purchase->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('purchase.update', $purchase) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar Compra
                                                        "{{ $purchase->title }}"</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Título</label>
                                                                <input type="text" class="form-control" name="title" required value="{{old('title',$purchase->title)}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Descripción</label>
                                                                <textarea name="description" class="form-control" id="description" cols="30" rows="1">{{$purchase->description}}</textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Producto</label>
                                                                <input type="text" readonly name="product_id" value="{{$purchase->product->bar_code ?? "" }}" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Cantidad</label>
                                                                <input type="number" step="any" class="form-control cantidad" data-id="{{$purchase->id}}" id="cantidad{{$purchase->id}}" name="quantity" required value="{{old('quantity',$purchase->quantity)}}">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Precio</label>
                                                                <input type="number" step="any" class="form-control" name="price" id="price{{$purchase->id}}" required readonly value="{{old('price',$purchase->price)}}">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Total</label>
                                                                <input type="number" step="any" class="form-control" id="total{{$purchase->id}}" name="total" required readonly value="{{old('total',$purchase->total)}}">
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
                            <form action="{{ route('purchase.store') }}" method="POST">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Nueva Compra</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Título</label>
                                                <input type="text" class="form-control" name="title" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Descripción</label>
                                                <textarea name="description" id="description" cols="30" rows="1" class="form-control" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Producto</label>
                                                <select name="product_id" id="product" class="form-control">
                                                    <option value="">--Seleccionar--</option>
                                                    <option value="nuevo">****Nuevo****</option>
                                                    <option value="otro">****Otro****</option>
                                                    @forelse ($products as $product)
                                                        <option value="{{$product->id}}">{{$product->bar_code}}-{{$product->numero_terreno}}-{{$product->colonia}}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Cantidad</label>
                                                <input type="number" id="cantidad" class="form-control" name="quantity" value="1" min="1" required>
                                            </div>
                                        </div>

                                    </div>
                                    <div id="producto-nuevo">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">ID</label>
                                                    <input type="text" class="form-control" name="bar_code" id="bar_code" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Lote</label>
                                                    <input type="text" class="form-control" name="lote" id="lote" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Manzana</label>
                                                    <input type="text" class="form-control" name="manzana" id="manzana" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Calle</label>
                                                    <input type="text" class="form-control" name="calle" id="calle" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Dimensiones(M<sup>2</sup>)</label>
                                                    <input type="text" class="form-control" name="dimenciones" id="dimensiones" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Colonia</label>
                                                    <input type="text" class="form-control" name="colonia" id="colonia" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Numero de terreno</label>
                                                    <input type="text" class="form-control" name="numero_terreno" id="numero_terreno" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="">Precio</label>
                                                    <input type="number" step="any" name="precio"  class="form-control" id="precio" min="0" required>
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
                                    <div class="row">
                                        <div class="col" id="precio_normal"> 
                                            <div class="form-group">
                                                <label for="">Precio</label>
                                                <input type="number" step="any" class="form-control" name="price" id="price" min="0" value="0" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Total</label>
                                                <input type="number" step="any" id="total" class="form-control" name="total" required readonly>
                                            </div>
                                        </div>
                                    </div>
                                  
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-success">Comprar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
            $('#precio').on('change',function(){
                total();
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
