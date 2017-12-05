$(document).ready(function () {
    if(!CheckPrivilege('SHOW_DELIVERED_ORDERS')){
        $('#content .box-content').html('Sorry, you don\'t have the privilege to view delivered orders.');
    }
    else{
        $('.ajax-loader').css('visibility','visible');
        $('#orderTable').html('');
        var orders = [];
        $.get('Pages/PagesPHP/OrdersPHP/GetDeliveredOrders.php',function (data) {
            if(data !== '') {
                orders = $.parseJSON(data);
                $(orders).each(function (id, order) {
                    $('#orderTable').append('<tr>' +
                        '<td>' + order['UNIQUE_ID'] + '</td>' +
                        '<td>' + order['PERSON'] + '</td>' +
                        '<td>' + order['NUMBER_OF_PRODUCTS'] + '</td>' +
                        '<td>' + order['ORDER_DATE_TIME'] + '</td>' +
                        '<td>' + order['PAYMENT_TYPE']+'</td>' +
                        '<td>' + order['TOTAL']+ ' ' + order['CURRENCY']+'</td>' +
                        '<td class="center">' +
                        '<a id="detailOrderBtn" class="btn btn-success" ' +
                        'onclick="$(\'#content\').load(\'Pages/PagesPHP/OrdersPHP/order_details.php?s=4&id='+order['ID']+'\')">' +
                        '<i class="halflings-icon white zoom-in"></i></a>'+
                        '</td></tr>'
                    );
                });
            }
            else{
                orders = [];
            }
            $('.datatable').DataTable();
        }).success(function () {
            $('.ajax-loader').css('visibility','hidden');
        });
    }

});