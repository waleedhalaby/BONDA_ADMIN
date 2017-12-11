$(document).ready(function () {
    if(!CheckPrivilege('SHOW_CANCELLED_ORDERS')){
        $('#content .box-content').html('Sorry, you don\'t have the privilege to view cancelled orders.');
    }
    else{
        $('.ajax-loader').css('visibility','visible');
        $('#orderTable').html('');

        var orders = [];
        $.get('Pages/PagesPHP/OrdersPHP/GetCancelledOrders.php',function (data) {
            if(data !== '') {
                orders = $.parseJSON(data);
                $(orders).each(function (id, order) {
                    $('#orderTable').append('<tr>' +
                        '<td>' + order['UNIQUE_ID'] + '</td>' +
                        '<td>' + order['PERSON'] + '</td>' +
                        '<td>' + order['ORDER_DATE_TIME'] + '</td>' +
                        '<td>' + order['PAYMENT_TYPE']+'</td>' +
                        '<td>' + order['TOTAL']+ ' EGP</td>' +
                        '<td class="center">' +
                        '<a id="detailOrderBtn" class="btn btn-primary" ' +
                        'onclick="$(\'#content\').load(\'Pages/PagesPHP/OrdersPHP/can_order_details.php?s=5&id='+order['ID']+'\')">' +
                        '<i class="halflings-icon white zoom-in"></i></a>'+
                        //'<a id="deleteOrderBtn" class="btn btn-danger" ' +
                        //'onclick="ShowModal(\'Order ['+order['UNIQUE_ID']+'] Delete\',\'Close\',\'Pages/PagesPHP/OrdersPHP/order_delete.php?u='+order['UNIQUE_ID']+'&s=5&id='+order['ID']+'\')">' +
                        //'<i class="halflings-icon white trash"></i></a>'+
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