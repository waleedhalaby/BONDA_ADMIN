$(document).ready(function(){
    $('#searchBtn').on('click',function(){
        if($('#orderID').val() !== ''){
            $('.ajax-loader').css('visibility','visible');
            $.get('Pages/PagesPHP/OrdersPHP/GetMainOrders.php?id='+$('#orderID').val(),function(data){
                var orders = $.parseJSON(data);
                if(orders.length > 0){
                    $('.orders').html(
                        '<table class="table table-striped table-bordered bootstrap-datatable datatable">' +
                        '                <thead>' +
                        '                <tr style="background-color: #0c5460;color:#F4F4F4;">' +
                        '                    <th>UNIQUE ID</th>' +
                        '                    <th>FROM</th>' +
                        '                    <th>ORDER DATE</th>' +
                        '                    <th>PAYMENT TYPE</th>' +
                        '                    <th>TOTAL</th>' +
                        '                    <th>ACTIONS</th>' +
                        '                </tr>' +
                        '                </thead>' +
                        '                <tbody id="orderTable">' +
                        '                </tbody>' +
                        '            </table>'
                    );

                    $(orders).each(function (id, order) {
                        $('.orders tbody#orderTable').append('<tr>' +
                            '<td>' + order['UNIQUE_ID'] + '</td>' +
                            '<td>' + order['PERSON'] + '</td>' +
                            '<td>' + order['ORDER_DATE_TIME'] + '</td>' +
                            '<td>' + order['PAYMENT_TYPE']+'</td>' +
                            '<td>' + order['TOTAL']+ ' EGP</td>' +
                            '<td class="center">' +
                            '<a id="detailOrderBtn" class="btn btn-success" ' +
                            'onclick="$(\'#content\').load(\'Pages/PagesPHP/OrdersPHP/main_order_details.php?s=4&id='+order['ID']+'\')">' +
                            '<i class="halflings-icon white zoom-in"></i></a>'+
                            '</td></tr>'
                        );
                    });
                }
                else{
                    $('.orders').html('No orders found.');
                }
            }).success(function () {
                $('.ajax-loader').css('visibility','hidden');
            });
        }
    })
});