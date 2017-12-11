<?php
    $MAKER_ID = $_GET['m'];
    $STATUS = $_GET['s'];
    $UNIQUE = $_GET['u'];
    $ORDER_ID = $_GET['id']
?>


<div class="modal-ship-date-content">
    <p>Default Days For Shipment: 5 days</p>
    <form id="shipDateForm">
        <table class="table table-striped table-bordered ship-date-table">
            <tr>
                <td style="background-color: #0c5460;color:#F4F4F4;">SHIPMENT DATE</td>
                <td><input class="val" type="date" id="addShipDate" name="addShipDate" placeholder="Enter Shipment Date"/></td>
            </tr>
        </table>
        <input type="submit" style="float: right" class="btn btn-warning" id="addShipBtn" value="Save"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#shipDateForm').submit(function(e){
            e.preventDefault();

            $('#addShipBtn').attr('disabled','true');
            $('#addShipBtn').attr('value','Sending, please wait...');

            var currentDate = new Date();
            var dd = currentDate.getDate() + 5;
            var mm = currentDate.getMonth() + 1;
            var y = currentDate.getFullYear();

            var ship_date = y + '_'+ mm + '_'+ dd;

            if($('#addShipDate').val()){
                ship_date = $('#addShipDate').val();
            }
            var url = "Pages/PagesPHP/OrdersPHP/UpdateOrderStatus.php?sd="+ship_date+"&m=<?php echo $MAKER_ID ?>&s=3&u=<?php echo $UNIQUE ?>&id=<?php echo $ORDER_ID ?>";

            $.ajax({
                type: "POST",
                url: url,
                success: function (data) {
                    if(data === "1") {
                        $('#content').load('Pages/QueuedOrders.php');
                        $('.modal-ship-date-content').html('<div class="container-fluid text-center"><span class="label label-warning">Order is Confirmed as shipped Successfully.</span></div>');
                        $( "#MyModal").unbind( "hide" );
                    }
                    else{
                        $('.modal-ship-date-content').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-ship-date-content').html('Error occurred, please contact your administrator.');
                }
            });
        });
    });
</script>
