<?php

session_start();
$PERSON_ID = $_SESSION['id'];

$DESIGNER_ID = $_GET['id'];
$VALUE = explode('$',$_GET['value']);
$DESIGNER = str_replace('+',' ',$VALUE[0]);
$DESCRIPTION = str_replace('+',' ',$VALUE[1]);

?>
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <em>Home</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-star"></i>
        <em>Products Portal</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-magic"></i>
        <em>Designers</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-edit"></i>
        <em>Edit Designer</em>
    </li>
</ul>
<div class="ajax-loader2">
    <img src="Images/Preloader_1.gif" class="img-responsive"/>
</div>
<div class="modal-designer-edit-content">
    <form id="editDesignerForm">
        <table class="table table-striped table-bordered designer-details-table">
            <tbody></tbody>
        </table>
        <div id="message" class="container-fluid text-center"></div>
        <input type="reset" style="float: right;" class="btn btn-danger" onclick="$('#content').load('Pages/Designers.php')" value="Back"/>
        <input type="submit" style="float: right" class="btn btn-warning" id="editDesignerBtn" value="Save"/>
    </form>
</div>
<script>
    $(document).ready(function(){
        $('.designer-details-table tbody').html(
            '<tr><td style="background-color: #0c5460;color:#F4F4F4;">DESIGNER*</td><td><input id="editDesigner" name="editDesigner" type="text" value="<?php echo $VALUE[0] ?>"/></td></tr>'+
            '<tr><td style="background-color: #0c5460;color:#F4F4F4;">DESCRIPTION</td><td><textarea id="editDescription" name="editDescription"><?php echo $VALUE[1] ?></textarea></td></tr>'
        );

        $('#editDesignerForm').submit(function(e){
            e.preventDefault();

            $('#editDesignerBtn').attr('disabled','true');
            $('#editDesignerBtn').attr('value','Sending, please wait...');

            var url = "Pages/PagesPHP/DesignersPHP/EditDesigner.php?maker=<?php echo $PERSON_ID ?>&id=<?php echo $DESIGNER_ID ?>";


            $.ajax({
                type: "POST",
                url: url,
                data: $('#editDesignerForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully")>= 0) {
                        $('#content').load('Pages/Designers.php');
                        $('#message').html('');
                        ShowMessageModal('Message','<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');
                        $( "#MyModal").unbind( "hide" );
                    }
                    else{
                        $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</div>');
                }
            });
        });
    });
</script>