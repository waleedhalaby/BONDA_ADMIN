<?php
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
        <em>Add Collection</em>
    </li>
</ul>
<div class="modal-category-add-content">
    <form id="addCategoryForm">
        <table class="table table-striped table-bordered category-details-table">
            <tbody>
                    <tr><td style="background-color: #0c5460;color:#F4F4F4;">COLLECTION</td><td><input name="addCategory" id="addCategory" type="text" placeholder="Enter Collection" required/></td></tr>
            </tbody>
        </table>
        <div id="message" class="container-fluid text-center"></div>
        <input type="reset" style="float: right;" class="btn btn-danger" onclick="$('#content').load('Pages/Categories.php')" value="Back"/>
        <input type="submit" style="float: right" class="btn btn-warning" id="addCategoryBtn" value="Add"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#addCategoryForm').submit(function(e){
            e.preventDefault();

            $('#addCategoryBtn').attr('disabled','true');
            $('#addCategoryBtn').attr('value','Sending, please wait...');

            var url = "Pages/PagesPHP/CategoriesPHP/AddCategory.php?maker=<?php echo $PERSON_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#addCategoryForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >=0){
                        $('#content').load('Pages/Categories.php');
                        $('#message').html('');
                        ShowMessageModal('Message','<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');
                    }
                    else{
                        $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                }
            });
        });
    });
</script>