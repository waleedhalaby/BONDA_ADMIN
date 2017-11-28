<?php
$MEMBER_ID = $_GET['id'];
?>

<div class="modal-member-edit-content">
    <form id="editMemberForm">
        <table class="table table-striped table-bordered member-details-table">
            <tbody></tbody>
        </table>
        <input type="submit" style="float: right" class="btn btn-warning" value="Save"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        var counter = 0;
        $.get('Pages/PagesPHP/AdminsPHP/GetDetails.php?id=<?php echo $MEMBER_ID ?>',function(data) {
            var person = $.parseJSON(data);

            $('.member-details-table tbody').html(
                '<tr><td>ID</td><td>['+person[0]['ID']+']</td></tr>'+
                '<tr><td>FIRST NAME</td><td><input id="EditfName" name="EditfName" type="text" value="'+person[0]['FIRST_NAME']+'"/></td></tr>'+
                '<tr><td>LAST NAME</td><td><input id="EditlName" name="EditlName" type="text" value="'+person[0]['LAST_NAME']+'"/></td></tr>'+
                '<tr><td>E-MAIL</td><td><input id="EditEmail" name="EditEmail" type="text" value="'+person[0]['EMAIL']+'"/></td></tr>'+
                '<tr><td>ROLE</td><td>'+person[0]['TYPE']+'</td></tr>'
            );
            $(person[0]['FEATURES']).each(function(id,feature){
                $('.member-details-table tbody').append(
                    '<tr><td>'+feature['FEATURE']+'</td><td><input name="FeatureID" type="hidden" value="'+feature['ID']+'"/>' +
                    '<input id="FEATURE'+counter+'" name="FEATURE'+counter+
                    '" type="text" value="'+feature['VALUE']+'"/></td></tr>'
                );
                counter++;
            });
        });

        $('#editMemberForm').submit(function(e){
            var url = "Pages/PagesPHP/AdminsPHP/EditMember.php?id=<?php echo $MEMBER_ID ?>&features="+counter;
            e.preventDefault();
            $.ajax({
               type: "POST",
               url: url,
               data: $('#editMemberForm').serialize(),
               success: function(data){
                   $('#content').load('Pages/Admins.php');
                   $('.modal-member-edit-content').html('Member is Updated Successfully.');
                   console.log(data);
               },
                error: function(data){
                    $('.modal-member-edit-content').html('Error occurred, please contact your administrator.');
                    console.log(data);
                }
            });
        });
    });
</script>