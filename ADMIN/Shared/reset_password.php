<?php
    session_start();
    $PERSON_ID = $_SESSION['id'];
?>

<div class="modal-reset-edit-content">
    <form id="ResetForm">
        <table class="table table-striped table-bordered reset-details-table">
            <tbody></tbody>
        </table>
        <div id="message" class="container-fluid text-center"></div>
        <input type="submit" style="float: right" class="btn btn-warning" id="editResetBtn" value="Reset"/>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('.reset-details-table tbody').html(
            '<tr><td style="background-color: #0c5460;color:#F4F4F4;">PASSWORD</td><td><input placeholder="Enter password" id="editPassword" name="editPassword" type="password"/></td></tr>'+
            '<tr><td style="background-color: #0c5460;color:#F4F4F4;">CONFIRM PASSWORD</td><td><input placeholder="Confirm password" id="editCPassword" name="editCPassword" type="password"/></td></tr>'
        );

        $('#ResetForm').submit(function(e){
            e.preventDefault();
            var url = "Shared/ResetPassword.php?id=<?php echo $PERSON_ID ?>";

            $.ajax({
                type: "POST",
                url: url,
                data: $('#ResetForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >= 0) {
                        $( "#MyModal").unbind( "hide" );
                        window.location.href = "Handlers/Logout.php";
                    }
                    else{
                        $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.'+data+'</div>');
                }
            });
        });
    });
</script>
