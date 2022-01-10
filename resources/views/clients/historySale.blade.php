<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-sm text-gray-500 leading-tight">
           Historial Cliente: 
         </h2>
         <h3 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$cliente[0]->name}} {{$cliente[0]->last_name}}
         </h3>
         
    </x-slot>
@php
    $deuda = 0;
@endphp

    <div class="py-12">
        <h1  class="font-semibold text-xl text-gray-800 leading-tight" style="padding: 20px">Productos Comprados</h1>
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
                                <th>Credito</th>
                                <th>Saldo</th>
                                <th>Ultimo Abono</th>
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
                                    <td>${{$sale->cart_subtotal}}</td>
                                    <td>${{$sale->amount_discount}}</td>
                                   
                                    @php
                                    $llaves = count($sale->abonos);
                                @endphp 
                                  @forelse ($sale->abonos as $key => $itemHistory)  
                                 
                                   
                                    
                                   @if (($key+1) === $llaves)
                                   <td style="color:white"> 
                                        @if ($itemHistory->faltante > 0)
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$sale->id}}"> 
                                              <p style="background-color: red; ">Adeudo</p>
                                            </button>
                                        @else
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$sale->id}}">
                                                <p style="background-color: green">Pagado</p>
                                            </button>>
                                        @endif
                                    </td>
                                    <td>${{$itemHistory->faltante}}</td>
                                    @php
                                        $deuda += $itemHistory->faltante;
                                    @endphp
                                    <td>${{$itemHistory->pay}}</td>
                                   @else
                               
                                   @endif
                                     
                                   
                                   
                                     @empty
                                     <td>
                                        <p style="color: black">Pago de contado</p> 
                                        </td>
                                        <td>$0.00</td>
                                        <td>$0.00</td>
                                     @endforelse
                                       
                                    
                          
                             
                                    <td>$ {{$sale->cart_total}}</td>
                               
                                  
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
                <div>
                      <h3 class="float-right font-semibold text-xl text-gray-800 leading-tight" style="padding-right: 20px">Saldo Total: ${{$deuda}}</h3>
                    </div>
                    @forelse ($cliente[0]->sales as $sale)
                    <div class="modal fade" id="exampleModal{{$sale->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                               
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Historial abonos
                                            {{ $cliente[0]->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                   <div class="modal-body">
                                      
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>ID Venta</th>
                                                <th>Abono</th>
                                                <th>Faltante</th>
                                                <th>Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         @forelse ($sale->abonos as $key => $itemHistory)  
                                            <tr>
                                                <td>{{$sale->id}}</td>
                                                <td>${{$itemHistory->pay}}</td>
                                                <td>${{$itemHistory->faltante}}</td>
                                                <td>{{$itemHistory->created_at}}</td>
                                            </tr>
                                            @empty
                                            @endforelse                                              
                                        </tbody>
                                    </table>
                       
                                     </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                           
                            </div>
                        </div>
                    </div>
          @empty
              
          @endforelse
           
</x-app-layout>