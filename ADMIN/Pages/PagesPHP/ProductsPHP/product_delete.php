<?php
$PRODUCT_ID = $_GET['id'];
$PRODUCT_NAME = $_GET['val'];

    session_start();
    $PERSON_ID = $_SESSION['id'];
?>

<div class="modal-product-delete-content">
    <form id="deleteProductForm">
        <p>Are you sure you want to delete product [<?php echo $PRODUCT_NAME ?>]?</p>
        <input type="submit" id="deleteProductBtn" style="float: right" class="btn btn-danger" value="Delete"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#deleteProductForm').submit(function(e){
            $('#deleteProductBtn').attr('disabled','true');
            $('#deleteProductBtn').attr('value','Sending, please wait...');
            e.preventDefault();
            var url = "Pages/PagesPHP/ProductsPHP/DeleteProduct.php?val=<?php echo $PRODUCT_NAME ?>&maker=<?php echo $PERSON_ID ?>&id=<?php echo $PRODUCT_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#deleteProductForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >=0){
                        $('#content').load('Pages/Products.php');
                        $('.modal-product-delete-content').html('<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');
                    }
                    else{
                        $('.modal-product-delete-content').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-product-delete-content').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                }
            });
        });
    });
</script>