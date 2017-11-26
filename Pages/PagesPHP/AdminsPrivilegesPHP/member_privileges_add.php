<div class="modal-privilege-add-content">
    <form id="addPrivilegeForm">
        <table class="table table-striped table-bordered member-details-table">
            <tbody>
            <tr><td>PRIVILEGE</td><td><input id="Privilege" name="Privilege" type="text" placeholder="Enter Privilege" required/></td></tr>
            </tbody>
        </table>
        <input type="submit" style="float: right" class="btn btn-warning" id="addPrivilegeBtn" value="Add"/>
    </form>
</div>

<script>
    $(document).ready(function(){

        $('#addPrivilegeForm').submit(function(e){
            e.preventDefault();
            var url = "Pages/PagesPHP/AdminsPrivilegesPHP/AddPrivilege.php";
            $.ajax({
                type: 'POST',
                url: url,
                data: $('#addPrivilegeForm').serialize(),
                success: function (data) {

                    $('#content').load('Pages/AdminsPrivileges.php');
                    $('.modal-privilege-add-content').html('Privilege is Added Successfully.');
                },
                error: function(data){
                    $('.modal-privilege-add-content').html('Error occurred, please contact your administrator.');
                }
            });
        });

    });
</script>