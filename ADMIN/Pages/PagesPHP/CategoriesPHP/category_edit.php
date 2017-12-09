<?php
$CATEGORY_ID = $_GET['id'];
$VALUE = $_GET['value'];
$VALUE = str_replace('_',' ',$VALUE);
session_start();
$PERSON_ID = $_SESSION['id'];
?>
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <em>Home</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-star"></i>
        <em>Products Portal</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-tasks"></i>
        <em>Collections</em>
    </li>
    <li>
        <i class="icon-plus-sign"></i>
        <em>Edit Collection</em>
    </li>
</ul>
<div class="modal-category-edit-content">
    <form id="editCategoryForm">
        <table class="table table-striped table-bordered category-details-table">
            <tbody></tbody>
        </table>
        <div id="message" class="container-fluid text-center"></div>
        <input type="reset" class="btn btn-danger" onclick="$('#content').load('Pages/Categories.php')" value="Back"/>
        <input type="submit" style="float: right" class="btn btn-warning" id="editCategoryBtn" value="Save"/>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('.category-details-table tbody').html(
            '<tr><td style="background-color: #0c5460;color:#F4F4F4;">COLLECTION</td><td><input id="editCategory" name="editCategory" placeholder="Enter Collection" type="text" value="<?php echo $VALUE ?>"/></td></tr>'
        );

        $('#editCategoryForm').submit(function(e){
            e.preventDefault();

            $('#editCategoryBtn').attr('disabled','true');
            $('#editCategoryBtn').attr('value','Sending, please wait...');

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