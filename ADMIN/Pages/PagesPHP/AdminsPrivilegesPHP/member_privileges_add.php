<?php
session_start();
$PERSON_ID = $_SESSION['id'];
?>

<div class="modal-privilege-add-content">
    <form id="addPrivilegeForm">
        <table class="table table-striped table-bordered member-details-table">
            <tbody>
            <tr><td style="background-color: #0c5460;color:#F4F4F4;">PRIVILEGE</td><td><input id="Privilege" name="Privilege" type="text" placeholder="Enter Privilege" required/></td></tr>
            </tbody>
        </table>
        <p id="message"></p>
        <input type="submit" style="float: right" class="btn btn-warning" id="addPrivilegeBtn" value="Add"/>
    </form>
</div>

<script>
    $(document).ready(function(){

        $('#addPrivilegeForm').submit(function(e){
            e.preventDefault();
            var url = "Pages/PagesPHP/AdminsPrivilegesPHP/AddPrivilege.php?maker=<?php echo $PERSON_ID ?>";
            $.ajax({
                type: 'POST',
                url: url,
                data: $('#addPrivilegeForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >= 0){
                        $('#content').load('Pages/AdminsPrivileges.php');
                        $('.modal-privilege-add-content').html('<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');
                    }
                    else{
                        $('.modal-privilege-add-content #message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-privilege-add-content #message').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                }
            });
        });

    });
</script>