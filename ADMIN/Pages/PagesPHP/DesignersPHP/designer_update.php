<?php
$DESIGNER_ID = $_GET['id'];
$STATUS = $_GET['status'];

session_start();
$PERSON_ID = $_SESSION['id'];
?>

<div class="modal-designer-edit-content">
    <form id="editDesignerForm">
        <?php
        if($STATUS == 'true')
        {
            echo '<p>Are you sure you want to activate designer?</p>';
            echo '<input type="hidden" id="editDesignerVal" name="editDesignerVal" value="true"/>';
            echo '<input type="submit" style="float: right" class="btn btn-warning" id="updateDesignerBtn" value="Activate"/>';
        }
        else
        {
            echo '<p>Are you sure you want to deactivate designer?</p>';
            echo '<input type="hidden" id="editDesignerVal" name="editDesignerVal" value="false"/>';
            echo '<input type="submit" style="float: right" class="btn btn-danger" id="updateDesignerBtn" value="Deactivate"/>';
        }
        ?>
    </form>
    <p id="error"></p>
</div>

<script>
    $(document).ready(function(){
        $('#editDesignerForm').submit(function(e){
            e.preventDefault();

            $('#updateDesignerBtn').attr('disabled','true');
            $('#updateDesignerBtn').attr('value','Sending, please wait...');

            var url = "Pages/PagesPHP/DesignersPHP/UpdateDesigner.php?maker=<?php echo $PERSON_ID ?>&id=<?php echo $DESIGNER_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#editDesignerForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >= 0){
                        $('#content').load('Pages/Designers.php');
                        $('.modal-designer-edit-content').html('<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');
                        $( "#MyModal").unbind( "hide" );
                    }
                    else{
                        $('.modal-designer-edit-content #error').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-designer-edit-content #error').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                }
            });
        });
    });
</script>