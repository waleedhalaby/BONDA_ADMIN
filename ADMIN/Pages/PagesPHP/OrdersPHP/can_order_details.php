<?php
    $ORDER_ID = $_GET['id'];
    $STATUS = $_GET['s'];
    session_start();
?>
<div class="ajax-loader2">
    <img src="Images/Preloader_1.gif" class="img-responsive"/>
</div>
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <em>Home</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-book"></i>
        <em>Orders Portal</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-desktop"></i>
        <em>Orders Details</em>
    </li>
</ul>
<div class="modal-order-content">
<h4>Order</h4>
<table class="table table-striped table-bordered order-table">
    <tbody></tbody>
</table>
    <?php
    echo '<input type="reset" style="float: right" class="btn btn-danger" onclick="$(\'#content\').load(\'Pages/CancelledOrders.php\')" value="Back"/>';
    ?>
</div>
<script>
    var UNIQUE = '';
    $(document).ready(function(){
        $('.ajax-loader2').css('visibility','visible');
        $.get('Pages/PagesPHP/OrdersPHP/GetCancelledOrderDetails.php?id=<?php echo $ORDER_ID ?>',function(data){
            var order = $.parseJSON(data);
            UNIQUE = order['UNIQUE_ID'];
            var ship_date = '';
            if(order['SHIP_DATE_TIME'] !== null){
                ship_date = '<tr><td style="background-color: #0c5460;color:#F4F4F4;">SHIP DATE</td><td>'+order['SHIP_DATE_TIME']+'</td></tr>';
            }
            $('.order-table tbody').append(
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">UNIQUE ID</td><td>['+order['UNIQUE_ID']+']</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">BY</td><td>'+order['PERSON']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">ORDER DATE</td><td>'+order['ORDER_DATE_TIME']+'</td></tr>'+
                ship_date+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">PAYMENT TYPE</td><td>'+order['PAYMENT_TYPE']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">STATUS</td><td><label class="label label-warning">'+order['STATUS']+'</label></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">TOTAL</td><td>'+order['TOTAL']+ ' EGP</td></tr>'
            );
        }).success(function () {
            $('.ajax-loader2').css('visibility','hidden');
        });
    });
</script>
