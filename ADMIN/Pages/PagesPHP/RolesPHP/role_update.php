<?php
$ROLE_ID = $_GET['id'];
$STATUS = $_GET['status'];

session_start();
$PERSON_ID = $_SESSION['id'];
?>

<div class="modal-role-edit-content">
    <form id="editRoleForm">
    <?php
    if($STATUS == 'true')
    {
        echo '<p>Are you sure you want to activate role?</p>';
        echo '<input type="hidden" id="editRoleVal" name="editRoleVal" value="true"/>';
        echo '<input type="submit" style="float: right" class="btn btn-warning" id="editRoleBtn" value="Activate"/>';
    }
    else
    {
        echo '<p>Are you sure you want to deactivate role?</p>';
        echo '<input type="hidden" id="editRoleVal" name="editRoleVal" value="false"/>';
        echo '<input type="submit" style="float: right" class="btn btn-danger" id="editRoleBtn" value="Deactivate"/>';
    }
    ?>
    </form>
    <p id="error"></p>
</div>

<script>
    $(document).ready(function(){
        $('#editRoleForm').submit(function(e){
            e.preventDefault();
            var url = "Pages/PagesPHP/RolesPHP/UpdateRole.php?maker=<?php echo $PERSON_ID ?>&id=<?php echo $ROLE_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#editRoleForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >= 0){
                        $('#content').load('Pages/MemberRoles.php');
                        $('.modal-role-edit-content').html('<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');
                        $( "#MyModal").unbind( "hide" );
                    }
                    else{
                        $('.modal-role-edit-content #error').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-category-edit-content #error').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                }
            });
        });
    });
</script>