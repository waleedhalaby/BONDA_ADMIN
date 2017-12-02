<?php
$CATEGORY_ID = $_GET['id'];
$VALUE = $_GET['value'];
session_start();
$PERSON_ID = $_SESSION['id'];
?>

<div class="modal-category-edit-content">
    <form id="editCategoryForm">
        <table class="table table-striped table-bordered category-details-table">
            <tbody></tbody>
        </table>
        <div id="message" class="container-fluid text-center"></div>
        <input type="submit" style="float: right" class="btn btn-warning" id="editCategoryBtn" value="Save"/>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('.category-details-table tbody').html(
            '<tr><td style="background-color: #0c5460;color:#F4F4F4;">CATEGORY</td><td><input id="editCategory" name="editCategory" type="text" value="<?php echo $VALUE ?>"/></td></tr>'
        );

        $('#editCategoryForm').submit(function(e){
            e.preventDefault();

            var url = "Pages/PagesPHP/CategoriesPHP/EditCategory.php?maker=<?php echo $PERSON_ID ?>&id=<?php echo $CATEGORY_ID ?>";


            $.ajax({
                type: "POST",
                url: url,
                data: $('#editCategoryForm').serialize(),
                success: function (data) {
                    if(data === '') {
                        $('#content').load('Pages/Categories.php');
                        $('#message').html('');
                        $('#message').html('<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');
                        $( "#MyModal").unbind( "hide" );
                    }
                    else{
                        $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</div>');
                }
            });
        });
    });
</script>