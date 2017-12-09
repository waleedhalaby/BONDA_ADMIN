<?php
$CATEGORY_ID = $_GET['id'];
$STATUS = $_GET['status'];

session_start();
$PERSON_ID = $_SESSION['id'];
?>

<div class="modal-category-edit-content">
    <form id="editCategoryForm">
    <?php
    if($STATUS == 'true')
    {
        echo '<p>Are you sure you want to activate this collection?</p>';
        echo '<input type="hidden" id="editCategoryVal" name="editCategoryVal" value="true"/>';
        echo '<input type="submit" style="float: right" class="btn btn-warning" id="updateCategoryBtn" value="Activate"/>';
    }
    else
    {
        echo '<p>Are you sure you want to deactivate this collection?</p>';
        echo '<input type="hidden" id="editCategoryVal" name="editCategoryVal" value="false"/>';
        echo '<input type="submit" style="float: right" class="btn btn-danger" id="updateCategoryBtn" value="Deactivate"/>';
    }
    ?>
    </form>
    <p id="error"></p>
</div>

<script>
    $(document).ready(function(){
        $('#editCategoryForm').submit(function(e){
            e.preventDefault();

            $('#updateCategoryBtn').attr('disabled','true');
            $('#updateCategoryBtn').attr('value','Sending, please wait...');

            var url = "Pages/PagesPHP/CategoriesPHP/UpdateCategory.php?maker=<?php echo $PERSON_ID ?>&id=<?php echo $CATEGORY_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#editCategoryForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >= 0){
                        $('#content').load('Pages/Categories.php');
                        $('.modal-category-edit-content').html('<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');
                        $( "#MyModal").unbind( "hide" );
                    }
                    else{
                        $('.modal-category-edit-content #error').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-category-edit-content #error').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                }
            });
        });
    });
</script>