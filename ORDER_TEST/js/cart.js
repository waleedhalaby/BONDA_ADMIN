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
                $('#cartTable tbody').append(
                    '<tr>'+
                    '<td><img src="/BONDA_ADMIN/ADMIN/'+detail['IMAGE']+'" style="width: 50px;"/></td>'+
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
                console.log(data);
                if(data === "1") {
                    alert('Your cart is ordered successfully');
                    document.location.href="index.php";
                }
                else{
                    alert('Error occurred, please contact your administrator.');
                }
            },
            error: function(data){
                alert('Error occurred, please contact your administrator.');
            }
        });
    });
});