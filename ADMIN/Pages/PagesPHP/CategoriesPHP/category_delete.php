<?php
$CATEGORY_ID = $_GET['id'];

    session_start();
    $PERSON_ID = $_SESSION['id'];
?>

<div class="modal-category-delete-content">
    <form id="deleteCategoryForm">
        <p>Are you sure you want to delete this collection?</p>
        <p class="label label-success">Note that any products by this collection will be deleted</p>
        <input type="submit" style="float: right" class="btn btn-danger" id="deleteCategoryBtn" value="Delete"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#deleteCategoryForm').submit(function(e){
            e.preventDefault();

            $('#deleteCategoryBtn').attr('disabled','true');
            $('#deleteCategoryBtn').attr('value','Sending, please wait...');

            var url = "Pages/PagesPHP/CategoriesPHP/DeleteCategory.php?maker=<?php echo $PERSON_ID ?>&id=<?php echo $CATEGORY_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#deleteCategoryForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >=0){
                        $('#content').load('Pages/Categories.php');
                        $('.modal-category-delete-content').html('<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');

                    }
                    else{
                        $('.modal-category-delete-content').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-category-delete-content').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                }
            });
        });
    });
</script>