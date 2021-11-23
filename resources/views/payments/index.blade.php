<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Abonos
         </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Folio Venta</th>
                                <th>Total Venta</th>
                                <th>Adeudo</th>
                                <th>Abonos</th>
                                <th>Cliente</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($abonos as $abono)
                                <tr>
                                    <td>{{$abono->id}}</td>
                                    <td>{{$abono->cart_total}}</td>
                                    @php
                                        $pagos = 0;
                                        $adeudo = 0;
                                        foreach ($abono->abonos as $abo) {
                                            $pagos += $abo->pay;
                                        }
                                        $adeudo = $abono->cart_total - $pagos;
                                    @endphp
                                    <td>{{$adeudo}}</td>
                                    <td>{{$pagos}}</td>
                                    <td>{{$abono->client->name ?? ""}} {{$abono->client->last_name ?? ""}}</td>
                                    <td>
                                        <button class="btn btn-outline-primary" type="button" data-bs-toggle="modal" data-bs-target="#abonosModal{{$abono->id}}"><i class="bi bi-card-list"></i></button>
                                        <button class="btn btn-outline-success" type="button" data-bs-toggle="modal" data-bs-target="#pagoModal{{$abono->id}}"><i class="bi bi-cash"></i></button>
                                    </td>
                                </tr>
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                    {{ $abonos->links() }}
                </div>
                @forelse ($abonos as $abono)
                    <!-- Modal abonos -->
                    <div class="modal fade" id="abonosModal{{$abono->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Historial de abonos de la venta {{$abono->id}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Abono</th>
                                            <th>Adeudo</th>
                                            <th>Fecha</th>
                                            <th>Ticket</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($abono->abonos as $pago)
                                            <tr>
                                                <td>{{$pago->id}}</td>
                                                <td>${{$pago->pay}}</td>
                                                <td>${{$pago->faltante}}</td>
                                                <td>{{$pago->created_at}}</td>
                                                <td>
                                                    <a target="blank" href="{{route('payment.show',$pago)}}" type="button" class="btn btn-outline-primary"><i class="bi bi-ticket"></i></a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">Sin abonos</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Modal hacer pago -->
                    <div class="modal fade" id="pagoModal{{$abono->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                @php
                                    $pagos = 0;
                                    $adeudo = 0;
                                    foreach ($abono->abonos as $abo) {
                                        $pagos += $abo->pay;
                                    }
                                    $adeudo = $abono->cart_total - $pagos;
                                @endphp
                                <form action="{{route('payment.store')}}" method="POST">
                                    @csrf
                                    <input type="text" hidden value="{{$abono->id}}" name="sale_id">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Realizar abono de la venta {{$abono->id}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="">Adeudo</label>
                                                <input type="number" name="adeudo" readonly class="form-control" step="any" value="{{$adeudo}}">
                                            </div>
                                            <div class="col-md-6">
                                                <label for="">Abono</label>
                                                <input type="number" name="pay" class="form-control" step="any" max="{{$adeudo}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button class="btn btn-primary" type="submit">Pagar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty

                @endforelse
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
