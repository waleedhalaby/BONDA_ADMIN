<?php session_start(); $PERSON_ID = $_SESSION['id']; ?>
<div class="modal-member-add-content">
    <form id="addMemberForm">
        <table class="table table-striped table-bordered member-details-table">
            <tbody>
                    <tr><td style="background-color: #0c5460;color:#F4F4F4;">FIRST NAME</td><td><input id="addfName" name="addfName" type="text" placeholder="Enter First Name" required/></td></tr>
                    <tr><td style="background-color: #0c5460;color:#F4F4F4;">LAST NAME</td><td><input id="addlName" name="addlName" type="text" placeholder="Enter Last Name" required/></td></tr>
                    <tr><td style="background-color: #0c5460;color:#F4F4F4;">E-MAIL</td><td><input id="addEmail" name="addEmail" type="email" placeholder="Enter E-mail" required/></td></tr>
                    <tr><td style="background-color: #0c5460;color:#F4F4F4;">PASSWORD</td><td><input id="addPassword" name="addPassword" type="password" placeholder="Enter Password" required/></td></tr>
                    <tr><td style="background-color: #0c5460;color:#F4F4F4;">CONFIRM PASSWORD</td><td><input id="addPassword2" name="addPassword2" type="password" placeholder="Enter Password" required/></td></tr>
                    <tr><td style="background-color: #0c5460;color:#F4F4F4;">ROLE</td><td><select id="addRoleCB" name="addRoleCB" required></select></td></tr>
            </tbody>
        </table>
        <p id="error"></p>
        <input type="submit" style="float: right" class="btn btn-warning" id="addMemberBtn" value="Add"/>
    </form>
</div>

<script>
    $(document).ready(function(){

        $.get('Pages/PagesPHP/AdminsPHP/GetRoles.php',function(data){
            var array = $.parseJSON(data);

            $(array).each(function(id,val){
                $('#addRoleCB').append(
                    '<option value="'+val[0]+'">'+val[1]+'</option>'
                )
            });
        });

        $('#addMemberForm').submit(function(e){
            e.preventDefault();
            var url = "Pages/PagesPHP/AdminsPHP/AddMember.php?maker=<?php echo $PERSON_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#addMemberForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >= 0){
                        $('#error').html('');
                        $('#content').load('Pages/Admins.php');
                        $('.modal-member-add-content').html('<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');
                        $( "#MyModal").unbind( "hide" );
                    }
                    else{
                        $('#error').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-member-add-content').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                }
            });
        });
    });
</script>