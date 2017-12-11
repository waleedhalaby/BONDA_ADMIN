<?php
$ORDER_ID = $_GET['id'];
$STATUS = $_GET['s'];
$UNIQUE = $_GET['u'];

    session_start();
    $PERSON_ID = $_SESSION['id'];
?>

<div class="modal-order-delete-content">
    <form id="deleteOrderForm">
        <p>Are you sure you want to delete this order?</p>
        <input type="submit" style="float: right" class="btn btn-danger" id="deleteOrderBtn" value="Delete"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#deleteOrderForm').submit(function(e){
            e.preventDefault();

            $('#deleteOrderBtn').attr('disabled','true');
            $('#deleteOrderBtn').attr('value','Sending, please wait...');
            var url = '';
            var status = <?php echo $STATUS?>;
            switch(status){
                case 4:
                    url = "Pages/PagesPHP/OrdersPHP/DeleteOrder.php?u=<?php echo $UNIQUE ?>&s=4&maker=<?php echo $PERSON_ID ?>&id=<?php echo $ORDER_ID ?>";
                    break;
                case 5:
                    url = "Pages/PagesPHP/OrdersPHP/DeleteOrder.php?u=<?php echo $UNIQUE ?>&s=5&maker=<?php echo $PERSON_ID ?>&id=<?php echo $ORDER_ID ?>";
                    break;
            }
            $.ajax({
                type: 'POST',
                url: url,
                data: $('#deleteCategoryForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >=0){
                        switch(status){
                            case 4:
                                $('#content').load('Pages/DeliveredOrders.php');
                                break;
                            case 5:
                                $('#content').load('Pages/CancelledOrders.php');
                                break;
                        }
                        $('.modal-order-delete-content').html('<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');

                    }
                    else{
                        $('.modal-order-delete-content').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-order-delete-content').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                }
            });
        });
    });
</script>