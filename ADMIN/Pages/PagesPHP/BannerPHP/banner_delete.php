<?php
$BANNER_ID = $_GET['id'];

    session_start();
    $PERSON_ID = $_SESSION['id'];
?>

<div class="modal-banner-delete-content">
    <form id="deleteBannerForm">
        <p>Are you sure you want to delete this banner?</p>
        <input type="submit" style="float: right" class="btn btn-danger" id="deleteBannerBtn" value="Delete"/>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#deleteBannerForm').submit(function(e){
            e.preventDefault();

            $('#deleteBannerBtn').attr('disabled','true');
            $('#deleteBannerBtn').attr('value','Sending, please wait...');

            var url = "Pages/PagesPHP/BannerPHP/DeleteBanner.php?maker=<?php echo $PERSON_ID ?>&id=<?php echo $BANNER_ID ?>";

            $.ajax({
                type: 'POST',
                url: url,
                data: $('#deleteBannerForm').serialize(),
                success: function (data) {
                    if(data.indexOf("successfully") >=0){
                        $('#content').load('Pages/Banner.php');
                        $('.modal-banner-delete-content').html('<div class="container-fluid text-center"><span class="label label-warning">'+data+'</span></div>');

                    }
                    else{
                        $('.modal-banner-delete-content').html('<div class="container-fluid text-center"><span class="label label-danger">'+data+'</span></div>');
                    }
                },
                error: function(data){
                    $('.modal-banner-delete-content').html('<div class="container-fluid text-center"><span class="label label-danger">Error occurred, please contact your administrator.</span></div>');
                }
            });
        });
    });
</script>