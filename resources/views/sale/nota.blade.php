<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nota de credito</title>    
</head>
<body>

    <style>
        .center {
          display: block;
          margin-left: auto;
          margin-right: auto;
           
        }
        
        }
        .left{
            margin-left: 0px;
          margin-right: auto;
          margin-top: 0%;
          padding-top: 0%;
        }
        td,tr,table {
           
            border-collapse: collapse;
        }
        
        td.cantidad,th.cantidad {
            word-break: break-all;
        }
        td.precio,th.precio {
            word-break: break-all;
        }
        .centrado {
            text-align: center;
            align-content: center;
            width: 100%;
        }
        img {
            max-width: inherit;
            width: inherit;
        }
        table.borde
        {
        
          border-collapse:collapse;
        }
        }
        @media print{
          .oculto-impresion, .oculto-impresion *{
            display: none !important;
          }
        }

</style>
<div>
 
    <div>
        <table class="borde" width="100%;">
        <thead>
            <th class="borde" > <img class="left" src="{{asset('img/roven-capital.jpeg')}}" style="width:150px ; height:120px ;"  alt="Logotipo"></th>
            <th>   <p class="centrado">
                Roven Capital <br>
                Km. 18.5 Carretera Aldama <br>
                Chihuahua Chih. <br>
                Atendido por {{Auth::user()->name}} {{Auth::user()->last_name}} <br>
              
            
        </p></th>
            <th> 
                <p class="centrado">
                    RCIBO <br> <br>
                    Folio: {{$sale->id}} <br>
                    Fecha: <br> {{$sale->created_at->format('d-m-y h:m:s')}} 
                   
                </p>
               
        </th>
        </thead>
    </table>
     
     
     
    <hr>
    <section style="display: flex; justify-content: space-between; align-items: center;padding-top: 20%;" >
        <div id="pro-th" >CANTIDAD</div>
        <div id="pre-th">PRODUCTO  <br></div>
        <div id="cod-th">PRECIO</div>
        <div id="subtotal">DESCUENTO</div>
        <div id="subtotal">TOTAL</div>
    </section>
    <hr>
    @foreach($sale->productsInSale as $product)
        <div style="display: flex; align-items: center; justify-content: space-between;">
            <div id="pro-td">
                {{$product->quantity}}
            </div>
            <div id="pre-td" style="text-align: center;">{{$product->product->colonia}} </div>
            <div id="can-td" style="text-align: center; margin-right:1em !important;">${{number_format($product->sale_price,2,',','.')}} </div>
            <div id="can-td" style="text-align: center; margin-right:1em !important;">@if($product->discount != 0)${{number_format($product->discount,2,',','.')}}@else-@endif</div>
            <div id="subtotal" style="text-align: center;">${{number_format($product->subtotal,2,',','.')}} </div>
        </div>
        <img src="roven-capital-bac.jpeg" alt="">
        <hr>
    @endforeach
    <div id="total" style="padding-top: 40%;padding-left: 80%;">
     {{--   Pago a crédito: {{$client->name." ".$client->last_name}}
        Dias de pago: {{$client->payment_days}}--}} 
        @if($sale->discount != null)Descuento:  %{{number_format($sale->discount,2,'.',',')}}@endif
        <br>
        Subtotal:  ${{number_format($sale->cart_subtotal,2,'.',',')}}
        <br>
        Total: ${{number_format($sale->cart_total,2,'.',',')}}
    </div>
    
   
    <p class="centrado">¡GRACIAS POR SU COMPRA!</p>
    <br/>
    <br/>
    <br/>
    <p class="centrado">_____________________________</p>
    <p class="centrado">{{$client->name." ".$client->last_name}}</p>

</div>
</body>
<script>
    window.print();
    window.addEventListener("afterprint", function(event) {
        window.close()
    });
</script>
</html>
