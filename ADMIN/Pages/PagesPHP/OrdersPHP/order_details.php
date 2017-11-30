<?php
    $ORDER_ID = $_GET['id'];
    $STATUS = $_GET['s'];
?>
<div class="modal-order-content">
<h4>Order</h4>
<table class="table table-striped table-bordered order-table">
    <tbody></tbody>
</table>
<h4>Order Details</h4>
<table class="table table-striped table-bordered table-collapsed order-details-table">
    <thead>
        <tr style="background-color: #0c5460;color:#F4F4F4;">
            <th>IMAGE</th>
            <th>SKU_ID</th>
            <th>NAME</th>
            <th>QUANTITY</th>
            <th>PRICE</th>
        </tr>
    </thead>
    <tbody></tbody>
    <tfoot></tfoot>
</table>
    <?php
        if($STATUS == 1 || $STATUS == 2){
            echo '<div style="float: right" class="btn-group">
                    <button id="ConfirmBtn" class="btn btn-lg btn-success">Confirm</button>
                    <button id="RefuseBtn" class="btn btn-lg btn-danger">Refuse</button>
                </div>';
        }
    ?>

</div>
<script>
    $(document).ready(function(){

        $.get('Pages/PagesPHP/OrdersPHP/GetOrderDetails.php?id=<?php echo $ORDER_ID ?>',function(data){
            var order = $.parseJSON(data);

            $('.order-table tbody').append(
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">UNIQUE ID</td><td>['+order['UNIQUE_ID']+']</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">BY</td><td>'+order['PERSON']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">ORDER DATE</td><td>'+order['ORDER_DATE_TIME']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">PAYMENT TYPE</td><td>'+order['PAYMENT_TYPE']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">STATUS</td><td><label class="label label-warning">'+order['STATUS']+'</label></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">TOTAL</td><td>'+order['TOTAL']+ ' ' +order['CURRENCY']+'</td></tr>'
            );
            if(order['DETAILS'].length > 0){
                $(order['DETAILS']).each(function(id,detail){
                    var image = '';
                    if(detail['IMAGE'] !== ''){
                        image = '<img id="'+detail['IMAGE_ID']+'" style="width: 30px; height:30px" src="'+detail['IMAGE']+'"/>' +
                            '<img id="Big'+detail['IMAGE_ID']+'" style="display: none;position:absolute;width: 150px; height:150px" src="'+detail['IMAGE']+'"/>';
                    }
                    else{
                        image = '<img style="width: 30px; height:30px" src="Images/default-image.png"/>';
                    }
                    $('.order-details-table tbody').append(
                        '<tr><td>'+image+'</td>'+
                        '<td>'+detail['SKU_ID']+'</td>'+
                        '<td>'+detail['NAME']+'</td>'+
                        '<td>'+detail['QUANTITY']+'</td>'+
                        '<td>'+detail['PRICE']+ ' ' +detail['CURRENCY']+'</td></tr>'
                    );
                    $('.order-details-table tbody img#'+detail['IMAGE_ID']).hover(function(){
                        $('.order-details-table tbody img#Big'+detail['IMAGE_ID']).fadeIn().show();
                    },function(){
                        $('.order-details-table tbody img#Big'+detail['IMAGE_ID']).hide();
                    });
                });
                $('.order-details-table tfoot').append(
                    '<tr style="background-color: #a5a5a5; color: #f0f0f0"><td colspan="4">TOTAL</td><td class="text-right">'+order['TOTAL']+ ' ' +order['CURRENCY']+'</td></tr>'
                );
            }
        });

        $('#ConfirmBtn').on('click',function(){
            var url = '';
            var status = <?php echo $STATUS ?>;
            console.log(status);
            switch(status){
                case 1:
                    url = "Pages/PagesPHP/OrdersPHP/UpdateOrderStatus.php?s=2&id=<?php echo $ORDER_ID ?>";
                    break;
                case 2:
                    url = "Pages/PagesPHP/OrdersPHP/UpdateOrderStatus.php?s=3&id=<?php echo $ORDER_ID ?>";
                    break;
            }

            $.ajax({
                type: "POST",
                url: url,
                success: function (data) {
                    if(data === "1") {
                        switch(status){
                            case 1:
                                $('#content').load('Pages/PendingOrders.php');
                                $('.modal-order-content').html('<div class="container-fluid text-center"><span class="label label-warning">Order is Confirmed as queued Successfully.</span></div>');
                                break;
                            case 2:
                                $('#content').load('Pages/QueuedOrders.php');
                                $('.modal-order-content').html('<div class="container-fluid text-center"><span class="label label-warning">Order is Confirmed as shipped Successfully.</span></div>');
                                break;
                        }

                    }
                    else{
                        $('.modal-order-content').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-order-content').html('Error occurred, please contact your administrator.');
                }
            });
        });

        $('#RefuseBtn').on('click',function(){
            var status = <?php echo $STATUS ?>;
            var url = "Pages/PagesPHP/OrdersPHP/UpdateOrderStatus.php?s=5&id=<?php echo $ORDER_ID ?>";
            $.ajax({
                type: "POST",
                url: url,
                success: function (data) {
                    if(data === "1") {
                        switch(status){
                            case 1:
                                $('#content').load('Pages/PendingOrders.php');
                                $('.modal-order-content').html('<div class="container-fluid text-center"><span class="label label-warning">Order is Refused as cancelled Successfully.</span></div>');
                                break;
                            case 2:
                                $('#content').load('Pages/QueuedOrders.php');
                                $('.modal-order-content').html('<div class="container-fluid text-center"><span class="label label-warning">Order is Refused as cancelled Successfully.</span></div>');
                                break;
                        }
                    }
                    else{
                        $('.modal-order-content').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-order-content').html('Error occurred, please contact your administrator.');
                }
            });
        });
    });
</script>
