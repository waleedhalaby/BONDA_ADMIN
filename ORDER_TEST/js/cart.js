$(document).ready(function(){
    var cartId = 0;
    $.get('PagesPHP/GetCart.php',function(data){
        var cart = $.parseJSON(data);
        if(cart['DETAILS'].length > 0){
            $('#orderDiv').css('visibility','visible');
            $('#cartTable tbody').html('');
            var total = cart['TOTAL'];
            cartId= cart['ID'];
            $('#Total').html(total + ' ' + cart['DETAILS'][0]['CURRENCY']);
            $(cart['DETAILS']).each(function(id,detail){
                var image = '';
                if(detail['IMAGE'] !== ''){
                    image = '<img src="/BONDA_ADMIN/ADMIN/'+detail['IMAGE']+'" style="width: 50px;"/>';
                }
                else{
                    image = '<img src="/BONDA_ADMIN/ADMIN/Images/default-image.png" style="width: 50px;"/>'
                }
                $('#cartTable tbody').append(
                    '<tr>'+
                    '<td>'+image+'</td>'+
                    '<td>'+detail['SKU_ID']+'</td>'+
                    '<td>'+detail['NAME']+'</td>'+
                    '<td>'+detail['QUANTITY']+'</td>'+
                    '<td>'+detail['PRICE']+' '+detail['CURRENCY']+'</td>'+
                    '</tr>'
                );
            });
        }
        else{
            $('#orderDiv').css('visibility','hidden');
            $('#cartTable tbody').append(
                '<tr>'+
                '<td class="text-center" colspan="5">Your cart is empty</td>'+
                '</tr>'
            );
        }
    });

    $('#orderBtn').on('click',function(){
        var url = 'PagesPHP/Order.php?id='+cartId;
        $.ajax({
            type: "POST",
            url: url,
            data: null,
            success: function (data) {
                if(data === "1") {
                    document.location.href="index.php";
                    $('#message').html(
                        '<div class="alert alert-success">' +
                        '  <strong>Success!</strong> Your cart is ordered successfully' +
                        '</div>');
                }
                else{
                    $('#message').html(
                        '<div class="alert alert-danger">' +
                        '  <strong>Error!</strong> Error occurred, please contact your administrator.'+
                        '</div>');
                }
            },
            error: function(data){
                $('#message').html(
                    '<div class="alert alert-danger">' +
                    '  <strong>Error!</strong> Error occurred, please contact your administrator.'+
                    '</div>');
            }
        });
    });
});