<tbody id="result">
    @forelse ($clientes as $cliente)
   
        <tr>
            <a href=""></a>
            <td>{{ $cliente->id }}</td>
            <td>{{ $cliente->name }}</td>
            <td>{{ $cliente->last_name }}</td>
            <td>{{ $cliente->email }}</td>
            <td>{{ $cliente->phonenumber }}</td>
            <td>{{ $cliente->rfc }}</td>
            <td>{{ $cliente->direccion->calle}}</td>
            <td>{{ $cliente->direccion->numero_int}}</td>
            <td>{{ $cliente->direccion->numero_ext}}</td>
            <td>{{ $cliente->direccion->colonia}}</td>
            <td>{{ $cliente->direccion->estado}}</td>
            <td>{{ $cliente->direccion->ciudad}}</td>
            <td>
                <a href="{{route('historyClient',$cliente)}}" class="btn btn-outline-primary">
                    <i class="bi bi-eye"></i>
                </a>
                <button type="button" data-bs-toggle="modal"
                    data-bs-target="#exampleModal{{ $cliente->id }}"
                    class="btn btn-outline-success">
                    <i class="bi bi-pencil"></i>
                </button>
                <form action="{{route('clients.supr',$cliente)}}" method="Post" class="d-inline" id="eliminar">
                    @csrf
                     @method('PATCH')
                <button type="submit"  class="btn btn-outline-danger" >
                    <i class="bi bi-trash"></i>
                </button>
                </form>

            </td>
        </tr>
        <!-- Modal -->
    <div class="modal fade" id="exampleModal{{ $cliente->id }}" tabindex="-1"
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
                            <option value="Ciudad de M??xico">Ciudad de M??xico</option>
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
                            <option value="Cd. M??xico">Cd. M??xico</option>
                            <option value="Michoac??n">Michoac??n</option>
                            <option value="Morelos">Morelos</option>
                            <option value="Nayarit">Nayarit</option>
                            <option value="Nuevo Le??n">Nuevo Le??n</option>
                            <option value="Oaxaca">Oaxaca</option>
                            <option value="Puebla">Puebla</option>
                            <option value="Quer??taro">Quer??taro</option>
                            <option value="Quintana Roo">Quintana Roo</option>
                            <option value="San Luis Potos??">San Luis Potos??</option>
                            <option value="Sinaloa">Sinaloa</option>
                            <option value="Sonora">Sonora</option>
                            <option value="Tabasco">Tabasco</option>
                            <option value="Tamaulipas">Tamaulipas</option>
                            <option value="Tlaxcala">Tlaxcala</option>
                            <option value="Veracruz">Veracruz</option>
                            <option value="Yucat??n">Yucat??n</option>
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
        </div>
    @empty

    @endforelse
</tbody>