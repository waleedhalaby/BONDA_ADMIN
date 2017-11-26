<?php
    $MEMBER_ID = $_GET['id'];
?>

<div class="modal-member-delete-content">
    <form id="deleteMemberForm">
        <p>Are you sure you want to delete member?</p>
        <input type="submit" style="float: right" class="btn btn-danger" value="Delete"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#deleteMemberForm').submit(function(e){
            e.preventDefault();
            var url = "Pages/PagesPHP/AdminsPHP/DeleteMember.php?id=<?php echo $MEMBER_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#deleteMemberForm').serialize(),
                success: function (data) {
                    $('#content').load('Pages/Admins.php');
                    $('.modal-member-delete-content').html('Member is Deleted Successfully.');
                },
                error: function(data){
                    $('.modal-member-delete-content').html('Error occurred, please contact your administrator.');
                }
            });
        });
    });
</script>