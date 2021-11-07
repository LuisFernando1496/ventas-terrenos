const searchByBarcode = () =>
{
         $('#searchResult').empty();
         if($("#bar_code").val().length!=0){
             $.ajax({
                 url: "/sales/seachByCode",
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 type: 'GET',
                 contentType: "application/json; charset=iso-8859-1",
                 data: {'search':$('#bar_code').val()},
                 dataType: 'html',
                 success: function(data) {
                     result=JSON.parse(data);
                     if(result.length!==0){
                         addProduct(result[0].id)
                     }
                     else{
                         $('#resultTable').prop('hidden',false);
                         $('#searchResult').append(
                             '<tr class="item-result">'+
                                 '<td colspan="8">No se encontraron resultados</td>'+
                             '</tr>'
                         );
                     }
                     console.log( result);
                 },
                 error: function(e) {
                     console.log("ERROR", e);
                 },
             });
         }
         $("#bar_code").val('');
     }
   const addProduct = (idProduct) =>
   {
         let product = result.find(element => element.id == idProduct)
         $('#addedProductName').text(product.name);
         let exist = false;
         $('#shoppingList').children().each(function(){
             if($(this).data('id')===idProduct){
                 exist = true;
                 return true;
             }
         });
         $('#search').val('');
         $('#searchResult').empty();
         if(exist){
             let quantity = $('#product'+product.id).find('.quantity').val();
             quantity++;
             $('#product'+product.id).find('.quantity').val(quantity);
         }
         else{
            
             $('#shoppingList').append(
                 '<tr id="product'+product.id+'" data-id="'+product.id+'">'+
                     '<td>'+product.bar_code+'</td>'+
                     '<td class="name">'+product.colonia+'</td>'+
                     '<td class="brand-name">'+product.terreno+'</td>'+
                     '<td>'+product.lote+'</td>'+
                     '<td>'+product.manzana+'</td>'+
                     '<td>'+product.dimenciones+'</td>'+
                     '<td>'+product.proyecto+'</td>'+
                     '<td>'+product.unidad+'</td>'+
                     '<td>'+
                         '<input type="number" class="price observable form-control" style="width:150px;" value="'+product.precio+'"  required/>'+
                     '</td>'+
                     '<td>'+
                         '<div class="form-group" style="position: relative ">'+
                             '<input type="number" class="quantity observable form-control" style="width:150px;" value="1" min="1"  required/>'+
                             '<div class="invalid-tooltip quantity-tooltip"></div>'+
                         '</div>'+
                     ' </td>'+
                     '<td>'+
                         '<div class="form-group" style="position: relative ">'+
                             '<input type="number" class="discount observable form-control" style="width:150px;" value="0" min="0" max="100" required/>'+
                             '<div class="invalid-tooltip discount-tooltip"></div>'+
                         '</div>'+
                     '</td>'+

                     '<td>$<span class="subtotal">'+product.price+'</span></td>'+
                     '<td>'+
                         '<button type="button" data-id="'+product.id+'" class="btn btn-outline-danger btn-sm btn-delete"><small>QUITAR</small></button>'+
                     '</td>'+
                 '</tr>'
             );
             
             $('.observable').off();
             $('.price').off();
             
             $('.price').change(function(){
                 update(); 
             });
             $('.observable').change(function(){
                 update(); 
             });
             $('.observable').keyup(function(){
                 update(); 
             });
         }
         $('.btn-delete').click(function(){
             $('#product'+$(this).data('id')).remove(); 
            // update(); 
         });
       //  update(); 
     }