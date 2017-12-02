<?php
session_start();
$PERSON_ID = $_SESSION['id'];
?>
<div class="modal-category-add-content">
    <form id="addCategoryForm">
        <table class="table table-striped table-bordered category-details-table">
            <tbody>
                    <tr><td style="background-color: #0c5460;color:#F4F4F4;">CATEGORY</td><td><input name="addCategory" id="addCategory" type="text" placeholder="Enter Category" required/></td></tr>
            </tbody>
        </table>
        <p id="error"></p>
        <input type="submit" style="float: right" class="btn btn-warning" id="addCategoryBtn" value="Add"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#addCategoryForm').submit(function(e){
            e.preventDefault();
            var url = "Pages/PagesPHP/CategoriesPHP/AddCategory.php?maker=<?php echo $PERSON_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#addCategoryForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >=0){
                        $('#content').load('Pages/Categories.php');
                        $('.modal-category-add-content').html('<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');
                        $( "#MyModal").unbind( "hide" );
                    }
                    else{
                        $('.modal-category-add-content #error').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-category-add-content #error').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                }
            });
        });
    });
</script>