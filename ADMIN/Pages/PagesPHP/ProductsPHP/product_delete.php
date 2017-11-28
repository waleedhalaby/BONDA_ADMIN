<?php
    $PRODUCT_ID = $_GET['id'];
?>

<div class="modal-product-delete-content">
    <form id="deleteProductForm">
        <p>Are you sure you want to delete product?</p>
        <input type="submit" style="float: right" class="btn btn-danger" value="Delete"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#deleteProductForm').submit(function(e){
            e.preventDefault();
            var url = "Pages/PagesPHP/ProductsPHP/DeleteProduct.php?id=<?php echo $PRODUCT_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#deleteProductForm').serialize(),
                success: function () {
                    $('#content').load('Pages/Products.php');
                    $('.modal-product-delete-content').html('Product is Deleted Successfully.');
                },
                error: function(data){
                    $('.modal-product-delete-content').html('Error occurred, please contact your administrator.');
                }
            });
        });
    });
</script>