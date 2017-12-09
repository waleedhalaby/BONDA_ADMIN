<?php
session_start();
$PERSON_ID = $_SESSION['id'];
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
        <i class="icon-plus-sign"></i>
        <em>Add Designer</em>
    </li>
</ul>
<div class="modal-designer-add-content">
    <form id="addDesignerForm">
        <table class="table table-striped table-bordered designer-details-table">
            <tbody>
                    <tr><td style="background-color: #0c5460;color:#F4F4F4;">DESIGNER*</td><td><input name="addDesigner" id="addDesigner" type="text" placeholder="Enter Designer"
                                                                                                     required/></td></tr>
                    <tr><td style="background-color: #0c5460;color:#F4F4F4;">DESCRIPTION</td><td><textarea name="addDescription" id="addDescription"></textarea></td></tr>
            </tbody>
        </table>
        <div id="message" class="container-fluid text-center"></div>
        <input type="reset" style="float: right;" class="btn btn-danger" onclick="$('#content').load('Pages/Designers.php')" value="Back"/>
        <input type="submit" style="float: right" class="btn btn-warning" id="addDesignerBtn" value="Add"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#addDesignerForm').submit(function(e){
            e.preventDefault();

            $('#addDesignerBtn').attr('disabled','true');
            $('#addDesignerBtn').attr('value','Sending, please wait...');

            var url = "Pages/PagesPHP/DesignersPHP/AddDesigner.php?maker=<?php echo $PERSON_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#addDesignerForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >=0){
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
                    $('#message').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                }
            });
        });
    });
</script>