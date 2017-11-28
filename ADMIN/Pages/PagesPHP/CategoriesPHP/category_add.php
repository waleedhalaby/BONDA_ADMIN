<div class="modal-category-add-content">
    <form id="addCategoryForm">
        <table class="table table-striped table-bordered category-details-table">
            <tbody>
                    <tr><td>CATEGORY</td><td><input name="addCategory" id="addCategory" type="text" placeholder="Enter Category" required/></td></tr>
            </tbody>
        </table>
        <input type="submit" style="float: right" class="btn btn-warning" id="addCategoryBtn" value="Add"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#addCategoryForm').submit(function(e){
            e.preventDefault();
            var url = "Pages/PagesPHP/CategoriesPHP/AddCategory.php";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#addCategoryForm').serialize(),
                success: function () {
                    $('#content').load('Pages/Categories.php');
                    $('.modal-category-add-content').html('Category is Added Successfully.');
                },
                error: function(data){
                    $('.modal-category-add-content').html('Error occurred, please contact your administrator.');
                }
            });
        });
    });
</script>