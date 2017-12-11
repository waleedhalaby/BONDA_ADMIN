<?php
    $DESIGNER_ID = $_GET['id'];
    $DESIGNER_NAME = $_GET['val'];

    session_start();
    $PERSON_ID = $_SESSION['id'];
?>

<div class="modal-designer-delete-content">
    <form id="deleteDesignerForm">
        <p>Are you sure you want to delete <?php echo $DESIGNER_NAME ?>?</p>
        <p class="label label-success">Note that any collections or products by this designer will be deleted.</p>
        <input type="submit" style="float: right" id="deleteDesignerBtn" class="btn btn-danger" value="Delete"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#deleteDesignerForm').submit(function(e){
            e.preventDefault();

            $('#deleteDesignerBtn').attr('disabled','true');
            $('#deleteDesignerBtn').attr('value','Sending, please wait...');

            var url = "Pages/PagesPHP/DesignersPHP/DeleteDesigner.php?maker=<?php echo $PERSON_ID ?>&id=<?php echo $DESIGNER_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#deleteDesignerForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >=0){
                        $('#content').load('Pages/Designers.php');
                        $('.modal-designer-delete-content').html('<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');

                    }
                    else{
                        $('.modal-designer-delete-content').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-designer-delete-content').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                }
            });
        });
    });
</script>