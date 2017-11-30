<?php
$MEMBER_ID = $_GET['id'];
session_start();
$PERSON_ID = $_SESSION['id'];
?>

<div class="modal-member-edit-content">
    <form id="editMemberForm">
        <table class="table table-striped table-bordered member-details-table">
            <tbody></tbody>
        </table>
        <p id="error"></p>
        <input type="submit" style="float: right" class="btn btn-warning" value="Save"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        var counter = 0;
        $.get('Pages/PagesPHP/AdminsPHP/GetDetails.php?id=<?php echo $MEMBER_ID ?>',function(data) {
            var person = $.parseJSON(data);

            $('.member-details-table tbody').html(
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">ID</td><td>['+person[0]['ID']+']</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">FIRST NAME</td><td><input id="EditfName" name="EditfName" type="text" value="'+person[0]['FIRST_NAME']+'"/></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">LAST NAME</td><td><input id="EditlName" name="EditlName" type="text" value="'+person[0]['LAST_NAME']+'"/></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">E-MAIL</td><td><input id="EditEmail" name="EditEmail" type="email" value="'+person[0]['EMAIL']+'"/></td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">ROLE</td><td>'+person[0]['TYPE']+'</td></tr>'
            );
            $(person[0]['FEATURES']).each(function(id,feature){
                $('.member-details-table tbody').append(
                    '<tr><td style="background-color: #0c5460;color:#F4F4F4;">'+feature['FEATURE']+'</td><td><input name="FeatureID" type="hidden" value="'+feature['ID']+'"/>' +
                    '<input id="FEATURE'+counter+'" name="FEATURE'+counter+
                    '" type="text" value="'+feature['VALUE']+'"/></td></tr>'
                );
                counter++;
            });
        });

        $('#editMemberForm').submit(function(e){
            var url = "Pages/PagesPHP/AdminsPHP/EditMember.php?id=<?php echo $MEMBER_ID ?>&maker=<?php echo $PERSON_ID ?>&features="+counter;
            e.preventDefault();
            $.ajax({
               type: "POST",
               url: url,
               data: $('#editMemberForm').serialize(),
               success: function(data){
                   if(data.indexOf("successfully") >= 0){
                       $('#content').load('Pages/Admins.php');
                       $('.modal-member-edit-content').html('<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');
                   }
                   else{
                       $('.modal-member-edit-content #error').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                   }
               },
                error: function(data){
                    $('.modal-member-edit-content #error').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                }
            });
        });
    });
</script>