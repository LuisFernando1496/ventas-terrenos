<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Historial Cliente: {{$cliente[0]->name}} {{$cliente[0]->last_name}}
           
        </button>
         </h2>
    </x-slot>


    <div class="py-12">
        <h1  class="font-semibold text-xl text-gray-800 leading-tight">Productos Comprados</h1>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID. Venta</th>
                                <th>Empleado</th>
                                <th>Producto</th>
                                <th>Subtotal</th>
                                <th>Descuento</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cliente[0]->sales as $sale)
                           
                                <tr>
                                    
                                    <td>{{$sale->id}}</td>
                                    <td>{{$sale->user->name}}</td>
                                    <td>Terreno {{$sale->productsInSale[0]->product->dimenciones}}M<sup>2</sup>-Col-
                                        {{$sale->productsInSale[0]->product->colonia}}</td>
                                    <td>$ {{$sale->cart_subtotal}}</td>
                                    <td>{{$sale->amount_discount}}</td>
                                    <td>$ {{$sale->cart_total}}</td>
                                  
                                </tr>
                                <!-- Modal -->
                         {{--    <div class="modal fade" id="exampleModal{{ $cliente->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{ route('clients.update', $cliente) }}" method="POST">
                                                @csrf 
                                                @method('PATCH')
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar cliente
                                                        {{ $cliente->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                               <div class="modal-body">
                                    <div class="row">
                                        <input type="hidden" name="address_id" value="{{$cliente->address_id}}">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Nombre</label>
                                                <input type="text" class="form-control" name="name" value="{{$cliente->name}}" required> 
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Apellidos</label>
                                                <input type="text" class="form-control" name="last_name" value="{{$cliente->last_name}}" required>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">RFC</label>
                                                <input type="text" class="form-control" name="rfc" value="{{$cliente->rfc}}" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Correo</label>
                                                <input type="email" class="form-control" name="email" value="{{$cliente->email}}" required>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Colonia</label>
                                                <input type="text" class="form-control" name="colonia" value="{{$cliente->direccion->colonia}}" required> 
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Calle</label>
                                                <input type="text" class="form-control" name="calle" value="{{$cliente->direccion->calle}}" required>
                                            </div>
                                        </div>
                                       
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Telefono</label>
                                                <input type="text" class="form-control" name="phonenumber" value="{{$cliente->phonenumber}}"  required> 
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Numero Int..</label>
                                                <input type="text" class="form-control" name="numero_int" value="{{$cliente->direccion->numero_int}}" placeholder="Opcional" required> 
                                            </div>
                                        </div>
                                      
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Numero Ext.</label>
                                                <input type="text" class="form-control" name="numero_ext" value="{{$cliente->direccion->numero_ext}}" placeholder="Opcional" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Estado</label>
                                                <select class="form-control" type="text" name="estado" value="{{$cliente->direccion->estado}}" id="estado" value="" required>
                                                    <option value="Ciudad de México">Ciudad de México</option>
                                                    <option value="Aguascalientes">Aguascalientes</option>
                                                    <option value="Baja California">Baja California</option>
                                                    <option value="Baja California sur">Baja California Sur</option>
                                                    <option value="Campeche">Campeche</option>
                                                    <option value="Chiapas">Chiapas</option>
                                                    <option value="Chihuahua">Chihuahua</option>
                                                    <option value="Coahuila">Coahuila</option>
                                                    <option value="Colima">Colima</option>
                                                    <option value="Durango">Durango</option>
                                                    <option value="Guanajuato">Guanajuato</option>
                                                    <option value="Guerrero">Guerrero</option>
                                                    <option value="Hidalgo">Hidalgo</option>
                                                    <option value="Jalisco">Jalisco</option>
                                                    <option value="Cd. México">Cd. México</option>
                                                    <option value="Michoacán">Michoacán</option>
                                                    <option value="Morelos">Morelos</option>
                                                    <option value="Nayarit">Nayarit</option>
                                                    <option value="Nuevo León">Nuevo León</option>
                                                    <option value="Oaxaca">Oaxaca</option>
                                                    <option value="Puebla">Puebla</option>
                                                    <option value="Querétaro">Querétaro</option>
                                                    <option value="Quintana Roo">Quintana Roo</option>
                                                    <option value="San Luis Potosí">San Luis Potosí</option>
                                                    <option value="Sinaloa">Sinaloa</option>
                                                    <option value="Sonora">Sonora</option>
                                                    <option value="Tabasco">Tabasco</option>
                                                    <option value="Tamaulipas">Tamaulipas</option>
                                                    <option value="Tlaxcala">Tlaxcala</option>
                                                    <option value="Veracruz">Veracruz</option>
                                                    <option value="Yucatán">Yucatán</option>
                                                    <option value="Zacatecas">Zacatecas</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="row">
                                        
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="">Ciudad</label>
                                                <input type="text" class="form-control" name="ciudad" value="{{$cliente->direccion->ciudad}}"  required>
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
                                </div>--}}
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
                </div>
                </div>
                </div>

</x-app-layout>