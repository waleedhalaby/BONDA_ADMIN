$(document).ready(function () {
    $('#orderTable').html('');

    var orders = [];
    $.get('Pages/PagesPHP/OrdersPHP/GetCancelledOrders.php',function (data) {
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
                    'onclick="ShowModal(\'Order [#'+order['UNIQUE_ID']+'] Details\',\'Close\',\'Pages/PagesPHP/OrdersPHP/order_details.php?s=5&id='+order['ID']+'\',false)">' +
                    '<i class="halflings-icon white zoom-in"></i></a>'+
                    '</td></tr>'
                );
            });

            if(!CheckPrivilege('SHOW_CANCELLED_ORDER')){
                $('#content .box-content').html('Sorry, you don\'t have the privilege to view cancelled orders.');
            }
        }
        else{
            orders = [];
        }
        $('.datatable').DataTable();
    });
});