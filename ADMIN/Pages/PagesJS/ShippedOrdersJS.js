$(document).ready(function () {
    if(!CheckPrivilege('SHOW_SHIPPED_ORDERS')){
        $('#content .box-content').html('Sorry, you don\'t have the privilege to view shipped orders.');
    }
    else {
        $('#orderTable').html('');

        var orders = [];
        $('.ajax-loader').css('visibility', 'visible');
        $.get('Pages/PagesPHP/OrdersPHP/GetShippedOrders.php', function (data) {
            if (data !== '') {
                orders = $.parseJSON(data);
                $(orders).each(function (id, order) {
                    $('#orderTable').append('<tr>' +
                        '<td>' + order['UNIQUE_ID'] + '</td>' +
                        '<td>' + order['PERSON'] + '</td>' +
                        '<td>' + order['NUMBER_OF_PRODUCTS'] + '</td>' +
                        '<td>' + order['ORDER_DATE_TIME'] + '</td>' +
                        '<td>' + order['PAYMENT_TYPE'] + '</td>' +
                        '<td>' + order['TOTAL'] + ' ' + order['CURRENCY'] + '</td>' +
                        '<td class="center">' +
                        '<a id="detailOrderBtn" class="btn btn-success" ' +
                        'onclick="ShowModal(\'Order [#' + order['UNIQUE_ID'] + '] Details\',\'Close\',\'Pages/PagesPHP/OrdersPHP/order_details.php?s=3&id=' + order['ID'] + '\',true)">' +
                        '<i class="halflings-icon white zoom-in"></i></a>' +
                        '</td></tr>'
                    );
                });
            }
            else {
                orders = [];
            }
            $('.datatable').DataTable();
        }).success(function () {
            $('.ajax-loader').css('visibility', 'hidden');
        });
    }
});