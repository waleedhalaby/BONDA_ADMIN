<div class="modal-member-add-content">
    <form id="addMemberForm">
        <table class="table table-striped table-bordered member-details-table">
            <tbody>
                    <tr><td>FIRST NAME</td><td><input id="addfName" name="addfName" type="text" placeholder="Enter First Name" required/></td></tr>
                    <tr><td>LAST NAME</td><td><input id="addlName" name="addlName" type="text" placeholder="Enter Last Name" required/></td></tr>
                    <tr><td>E-MAIL</td><td><input id="addEmail" name="addEmail" type="text" placeholder="Enter E-mail" required/></td></tr>
                    <tr><td>PASSWORD</td><td><input id="addPassword" name="addPassword" type="password" placeholder="Enter Password" required/></td></tr>
                    <tr><td>CONFIRM PASSWORD</td><td><input id="addPassword2" name="addPassword2" type="password" placeholder="Enter Password" required/></td></tr>
                    <tr><td>ROLE</td><td><select id="addRoleCB" name="addRoleCB" required></select></td></tr>
            </tbody>
        </table>
        <p id="error" class="label label-danger"></p>
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
            var url = "Pages/PagesPHP/AdminsPHP/AddMember.php";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#addMemberForm').serialize(),
                success: function (data) {
                    console.log(data);
                    if(data === '1'){
                        $('#error').html('');
                        $('#content').load('Pages/Admins.php');
                        $('.modal-member-add-content').html('Member is added successfully.');
                    }
                    else{
                        $('#error').html('Wrong input, please try again.');
                    }
                },
                error: function(data){
                    $('.modal-member-add-content').html('Error occurred, please contact your administrator.');
                }
            });
        });
    });
</script>