


let result = [];
let generalSubtotal = 0;
let totalDiscount = 0;
let totalSale = 0;
let totalSaleUSD = 0;
let discountWarning = false;
let notificationsCount = 0;
$('#divabono').hide();
$('#payment_type').change( function() {
    if ($('#payment_type').val() == 1) {
        $('#ingress').prop('readonly', true);
        $('#ingress').val(totalSale);
        $('#abono').removeAttr('name');
        $('#abono').prop('hidden',true);
        $('#abono').prop('required',false);
        $('#divabono').hide();
        // client.style.visibility = 'hidden';
        update();
    }else if ($('#payment_type').val() == 0) {
        $('#ingress').prop('readonly', false);
        $('#abono').removeAttr('name');
        $('#abono').prop('hidden',true);
        $('#abono').prop('required',false);
        $('#divabono').hide();
        // client.style.visibility = 'hidden';
    }else{
        $('#ingress').prop('readonly', true);
        $('#ingress').val(0);
        $('#divabono').show();
        $('#abono').prop('hidden',false);
        $('#abono').val(1);
        $('#abono').prop('required',true);
        $('#abono').attr('name','abono');
        $('#abono').attr('min',1);
        if($( "#client_id option:selected" ).val()==""){
            console.log($( "#client_id option:selected" ).val());
            $('#paymentButton').prop('disabled',true);
        }else{
            console.log($( "#client_id option:selected" ).val());
            $('#paymentButton').prop('disabled',false);
        }
        // client.style.visibility = 'visible';
    }
});
$('#client_id').change( function() {
        if($( "#client_id option:selected" ).val()==""){
            console.log($( "#client_id option:selected" ).val());
            $('#paymentButton').prop('disabled',true);

        }else{
            console.log($( "#client_id option:selected" ).val());
            $('#paymentButton').prop('disabled',false);
        }
});

const buscar = (event) =>
            {
                event.preventDefault();
                $('#searchResult').empty();
                if($("#search").val().length!=0){
                    $.ajax({
                        url: "/sales/search",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'GET',
                        contentType: "application/json; charset=iso-8859-1",
                        data: {'search':$('#search').val().toUpperCase()},
                        dataType: 'html',
                        success: function(data) {
                            result=JSON.parse(data);
                            $('#resultTable').prop('hidden',false);
                            if(result.length!==0){
                                result.forEach(function(element,index){
                                    if (element.brand_name == undefined) {
                                        element.brand_name = 'Ninguna';
                                    }
                                    $('#searchResult').append(
                                        '<tr class="item-result" style="cursor: grab;" data-id="'+element.id+'">'+
                                            '<td>'+element.codigo+'</td>'+
                                            '<td>'+element.colonia+'</td>'+
                                            '<td>'+element.terreno+'</td>'+
                                            '<td>'+element.lote+'</td>'+
                                            '<td>'+element. manzana+'</td>'+
                                            '<td>'+element.dimenciones+'</td>'+
                                            '<td>'+element.precio+'</td>'+
                                            '<td>'+element.proyecto+'</td>'+
                                            '<td>'+element.unidad+'</td>'+
                                        '</tr>'
                                    );
                                });
                                $('.item-result').off();
                                $('.item-result').click(function() {
                                    $('#resultTable').prop('hidden',true);
                                    addProduct($(this).data('id'));
                                });
                            }
                            else{
                                $('#searchResult').append(
                                    '<tr class="item-result">'+
                                        '<td colspan="8">No se encontraron resultados</td>'+
                                    '</tr>'
                                );
                            }
                        },
                        error: function(e) {
                            console.log("ERROR", e);
                        },
                    });
                }
            }

const addProduct = (idProduct) => {
    let product = result.find(element => element.id == idProduct)
    console.log(product);
   // $('#addedProductName').text(product.colonia);
    let exist = false;
    $('#shoppingList').children().each(function () {
        if ($(this).data('id') === idProduct) {
            exist = true;
            return true;
        }
    });
    $('#search').val('');
    $('#searchResult').empty();
    if (exist) {
        let quantity = $('#product' + product.id).find('.quantity').val();
        quantity++;
        $('#product' + product.id).find('.quantity').val(quantity);
    }
    else {

        $('#shoppingList').append(
            '<tr id="product' + product.id + '" data-id="' + product.id + '">' +
            '<td>' + product.bar_code + '</td>' +
            '<td class="name">' + product.colonia + '</td>' +
            '<td class="brand-name">' + product.terreno + '</td>' +
            '<td>' + product.lote + '</td>' +
            '<td>' + product.manzana + '</td>' +
            '<td>' + product.dimenciones + '</td>' +
            '<td>' + product.proyecto + '</td>' +
            '<td>' + product.unidad + '</td>' +
            '<td>' +
            '<input type="number" class="price  form-control" style="width:150px;" value="' + product.precio + '"  required/>' +
            '</td>' +
            '<td>' +
            '<div class="form-group" style="position: relative ">' +
            '<input type="number" class="quantity observable form-control" style="width:150px;" value="1" min="1"  required/>' +
            '<div class="invalid-tooltip quantity-tooltip"></div>' +
            '</div>' +
            ' </td>' +
            '<td>' +
            '<div class="form-group" style="position: relative ">' +
            '<input type="number" class="discount observable form-control" style="width:150px;" value="0" min="0" max="100" required/>' +
            '<div class="invalid-tooltip discount-tooltip"></div>' +
            '</div>' +
            '</td>' +

            '<td>$<span class="subtotal">' + product.price + '</span></td>' +
            '<td>' +
            '<button type="button" data-id="' + product.id + '" class="btn btn-outline-danger btn-sm btn-delete"><small>QUITAR</small></button>' +
            '</td>' +
            '</tr>'
        );

        $('.observable').off();
        $('.price').off();

        $('.price').change(function () {
            update();
        });
        $('.observable').change(function () {
            update();
        });
        $('.observable').keyup(function () {
            update();
        });
    }
    $('.btn-delete').click(function () {
        $('#product' + $(this).data('id')).remove();
        update();
    });
    update();
}



const searchByBarcode = (event) => {
    event.preventDefault();

    $('#searchResult').empty();
    if ($("#bar_code").val().length != 0) {
        $.ajax({
            url: "/sales/seachByCode",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            contentType: "application/json; charset=iso-8859-1",
            data: { 'search': $('#bar_code').val() },
            dataType: 'html',
            success: function (data) {
                result = JSON.parse(data);
                if (result.length !== 0) {
                    addProduct(result[0].id)
                }
                else {
                    $('#resultTable').prop('hidden', false);
                    $('#searchResult').append(
                        '<tr class="item-result">' +
                        '<td colspan="8">No se encontraron resultados</td>' +
                        '</tr>'
                    );
                }
                console.log(result);
            },
            error: function (e) {
                console.log("ERROR", e);
            },
        });
    }
    $("#bar_code").val('');
}


const update = () => {
    let shoppingListForm = document.getElementById('shoppingListForm');
    generalSubtotal = 0;
    totalDiscount = 0;
    totalSale = 0;
    totalSaleUSD = 0;
    discountWarning = false;
    notificationsCount = 0
    $('.stock-warning').remove();
    $('.additional_discount-warning').remove();
    $('#shoppingList').children().each(function () {
        let price = parseFloat($(this).find('.price').val());
        let subtotal = parseFloat($(this).find('.subtotal').text());
        let quantity = $(this).find('.quantity').val();
        let discount = $(this).find('.discount').val();
        /*  let temporalStock=parseInt($(this).find('.quantity').prop('max'))-quantity;
          if(temporalStock<6){
              addNotification('stock-warning',$(this).find('.name').text()+' | '+$(this).find('.brand-name').text()+' tiene '+temporalStock+' productos en stock')
          }
          if(quantity<1 || quantity===''){
              $(this).find('.quantity-tooltip').text('Cantidad inválida.');
          }
          else if(quantity>$(this).find('.quantity').attr('max')){
              $(this).find('.quantity-tooltip').text('La cantidad supera el stock.');
          }
          if(discount<0||discount>99 || quantity===''){
              $(this).find('.discount-tooltip').text('Descuento inválido.');
          }   */
        generalSubtotal += quantity * price;
        generalSubtotal = ((Math.round((generalSubtotal) * 10000) / 10000));
        if (!parseInt($('#additional_discount').val()) > 0) {
            totalDiscount += quantity * (price * (discount / 100));
            totalDiscount = ((Math.round((totalDiscount) * 10000) / 10000));
            price = price - (price * (discount / 100));
            if (discount > 10) {
                discountWarning = true;
            }
        }

        subtotal = price * quantity;
        subtotal = ((Math.round((subtotal) * 10000) / 10000));
        totalSale += subtotal;
        totalSaleUSD += subtotal / 20;

        $(this).find('.subtotal').text(subtotal);
    });
    if (!parseInt($('#additional_discount').val()) > 0) {
        $('.discount').each(function () {
            $(this).prop('readonly', false);
        });
    }
    else {
        if ($('#additional_discount').val() > 0) {
            let discount = $('#additional_discount').val();
            totalDiscount = generalSubtotal * (discount / 100);
            totalDiscount = ((Math.round((totalDiscount) * 10000) / 10000));
            totalSale = generalSubtotal - (generalSubtotal * (discount / 100));
            totalSale = ((Math.round((totalSale) * 10000) / 10000));
            totalSaleUSD = totalSale / 20
            if (discount > 10) {
                discountWarning = true;
            }
            $('.discount').each(function () {
                $(this).prop('readonly', true);
            });
            addNotification('additional_discount-warning', 'Los descuentos sobre el total anulan los decuentos por producto');
        }
    }
    $('#totalDiscount').text(totalDiscount.toFixed(2));
    $('#generalSubtotal').text(generalSubtotal.toFixed(2));
    $('#totalSale').text(totalSale.toFixed(2));
    $('#totalSaleUSD').text(totalSaleUSD.toFixed(2));
    // if ($('#payment_type').val() == 1) {
    //     $('#ingress').val(totalSale.toFixed(2));
    // }else{
    //     $('#ingress').text(totalSale.toFixed(2));
    // }

        let turned = $('#ingress').val() - totalSale.toFixed(2);
        turned = ((Math.round((turned) * 10000) / 10000));
        console.log('holaaa======== '+turned)
        if ($('#payment_type').val() == 2) {
            $('#ingress').prop('min', 1);
        } else {
            $('#ingress').prop('min', totalSale.toFixed(2));
        }
        if (turned > 0) {
            //ACA CONVERTIR TOTAL A DLS Y REGRESAR CAMBIO EN MXN
            $('#turned').text(turned.toFixed(2));
        }
        else {
            $('#turned').text('0.00');
        }


    if (shoppingListForm.checkValidity() && totalSale !== 0) {
        $('#paymentButton').prop('disabled', false);
    }
    else {
        $('#paymentButton').prop('disabled', true);
    }
    $('#paymentButton').off();
    $('.discount-warning').remove();
    if (discountWarning) {
        addNotification('discount-warning', 'Los descuentos mayores a 10% necesitan autorización del gerente');
        $('#paymentButton').attr('data-toggle', 'modal');
        $('#paymentButton').attr('data-target', '#authorizationModal');

    }
    else {
        $('#paymentButton').click(function () {
            pay();
        });
        $('#paymentButton').removeAttr('data-toggle', 'modal');
        $('#paymentButton').removeAttr('data-target', '#authorizationModal');
    }
    $('#notificationsCount').text(notificationsCount);
    if (notificationsCount == 0) {
        $('#notificationsCount').prop('hidden', true);
    }
    else {
        $('#notificationsCount').prop('hidden', false);
    }

}


 const pay =() =>
 {
    $('input,select').each(function(){
        $(this).prop('readonly',true);
    });
    $('#authorizationModal').modal('hide');
    $('#paymentButton').prop('disabled',true);
    let items = [];
    $('#shoppingList').children().each(function (){
        let price = parseFloat($(this).find('.price').val());
        let total = parseFloat($(this).find('.subtotal').text());
        let quantity = parseFloat($(this).find('.quantity').val());
        let discount = parseFloat($(this).find('.discount').val());
        let subtotal = price * quantity;
        items.push({
            id : $(this).data('id'),
            quantity : quantity,
            discount : discount,
            sale_price : price,
            total : total,
            subtotal : subtotal
        });
    });
    let request = {
        sale : {
            payment_type: $('#payment_type').find(':selected').val(),
            amount_discount: totalDiscount,
            discount: parseInt($('#additional_discount').val()),
            cart_subtotal: generalSubtotal,
            cart_total: totalSale,
            turned: parseInt($('#turned').text()),
            ingress: parseInt($('#ingress').val()),
            client_id: $('#client_id').find(':selected').val()
        },
            products:items
        };
    $.ajax({
        url: "/sales",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        contentType: "application/json; charset=iso-8859-1",
        data:JSON.stringify(request),
        dataType: 'html',
        success: function(data) {
            if(JSON.parse(data).success){
                //console.log(JSON.parse(data).data.products_in_sale)
                console.log(JSON.parse(data).data.id)
                $('#saleReprintId').val(JSON.parse(data).data.id)
                $('#reprintForm').submit()
                location.reload();
            }
            else{
                alert(data);
                $('#paymentButton').prop('disabled',false);
                console.log(JSON.parse(data));
            }
        },
        error: function(e) {
            console.log("ERROR", e);
        },
    });
}
