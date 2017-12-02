<?php
session_start();
$PERSON_ID = $_SESSION['id'];
?>
<div class="modal-role-add-content">
    <form id="addRoleForm">
        <table class="table table-striped table-bordered role-details-table">
            <tbody>
                    <tr><td style="background-color: #0c5460;color:#F4F4F4;">ROLE</td><td><input name="addRole" id="addRole" type="text" placeholder="Enter Role" required/></td></tr>
            </tbody>
        </table>
        <p id="error"></p>
        <input type="submit" style="float: right" class="btn btn-warning" id="addRoleBtn" value="Add"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#addRoleForm').submit(function(e){
            e.preventDefault();
            var url = "Pages/PagesPHP/RolesPHP/AddRole.php?maker=<?php echo $PERSON_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#addRoleForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >=0){
                        $('#content').load('Pages/MemberRoles.php');
                        $('.modal-role-add-content').html('<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');
                        $( "#MyModal").unbind( "hide" );
                    }
                    else{
                        $('.modal-role-add-content #error').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-role-add-content #error').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                }
            });
        });
    });
</script>