<?php
    $MEMBER_ID = $_GET['id'];
    session_start();
    $PERSON_ID = $_SESSION['id'];
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
            var url = "Pages/PagesPHP/AdminsPHP/DeleteMember.php?id=<?php echo $MEMBER_ID ?>&maker=<?php echo $PERSON_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#deleteMemberForm').serialize(),
                success: function (data) {
                    $('#content').load('Pages/Admins.php');
                    $('.modal-member-delete-content').html('<div class="container-fluid text-center"><span class="label label-warning">Member is Deleted Successfully.</span></div>');
                },
                error: function(data){
                    $('.modal-member-delete-content').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                }
            });
        });
    });
</script>