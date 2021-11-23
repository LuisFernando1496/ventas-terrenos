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
td,th,tr,table {
    border-top: 1px solid black;
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
@media print{
  .oculto-impresion, .oculto-impresion *{
    display: none !important;
  }
}

</style>
<div>
    <img class="center" src="{{asset('/logo_inusual.png')}}" alt="Logotipo">
    <p class="centrado">
        {{-- Calle {{$sale->branchOffice->address->street}},Numero {{$sale->branchOffice->address->ext_number}} <br>
        Colonia {{$sale->branchOffice->address->suburb}} <br>--}}
        Atendido por {{Auth::user()->name}} {{Auth::user()->last_name}} <br>
        Fecha: {{$pay->created_at->format('d-m-y h:m:s')}} <br>
        Folio: {{$pay->id}}
    </p>
    <section style="display: flex; justify-content: space-between; align-items: center;">
        <div id="pre-th">Folio Venta  <br></div>
        <div id="cod-th">Total Venta</div>
        <div id="subtotal">Abonos</div>
        <div id="subtotal">Abono</div>
        <div id="subtotal">Restante</div>
    </section>
    <hr>
    <div style="display: flex; align-items: center; justify-content: space-between;">
        <div id="pre-td" style="text-align: center;">{{$pay->sale_id}} </div>
        <div id="can-td" style="text-align: center; margin-right:1em !important;">${{number_format($pay->venta->cart_total,2,',','.')}} </div>
        <div id="can-td" style="text-align: center; margin-right:1em !important;">${{number_format($abonos,2,',','.')}}</div>
        <div id="can-td" style="text-align: center; margin-right:1em !important;">${{number_format($pay->pay,2,',','.')}}</div>
        <div id="can-td" style="text-align: center; margin-right:1em !important;">${{number_format($pay->faltante,2,',','.')}}</div>
    </div>
    <img src="roven-capital-bac.jpeg" alt="">
    <hr>
    <p class="centrado">RFC:{{Auth::user()->rfc}} </p>
    <p class="centrado">Email: {{Auth::user()->email}}</p>
    <p class="centrado">¡GRACIAS POR SU COMPRA!</p>
    <br/>
    <br/>
    <br/>
    <p class="centrado">_____________________________</p>
    <p class="centrado">{{$pay->venta->client->name." ".$pay->venta->client->last_name}}</p>

</div>
</body>
<script>
    window.print();
    window.addEventListener("afterprint", function(event) {
        window.close()
    });
</script>
</html>
