<?php
session_start();
$PERSON_ID = $_SESSION['id'];

$BANNER_ID = $_GET['id'];
?>
<ul class="breadcrumb">
    <li>
        <i class="icon-home"></i>
        <em>Home</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-file"></i>
        <em>Pages Portal</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-picture"></i>
        <em>Banners</em>
        <i class="icon-angle-right"></i>
    </li>
    <li>
        <i class="icon-zoom-in"></i>
        <em>Banner Details</em>
    </li>
</ul>
<div class="ajax-loader2">
    <img src="Images/Preloader_1.gif" class="img-responsive"/>
</div>
<table class="table table-striped table-bordered banner-details-table">
    <tbody></tbody>
</table>
<button style="float: right;" class="btn btn-danger" onclick="$('#content').load('Pages/Banner.php')">Back</button>

<script>
    $(document).ready(function(){
        $('.ajax-loader2').css('visibility','visible');
        $.get('Pages/PagesPHP/BannerPHP/GetDetails.php?id=<?php echo $BANNER_ID ?>',function(data) {
            var banner = $.parseJSON(data);
            var image;
            if(banner['IMAGE'] !== null){
                image = '<tr><td colspan="2" style="text-align: left">' +
                    '<img id="imageThumb'+banner['ID']+'" style="width:250px;height:250px;" class="img-polaroid compress-image" ' +
                    'src="'+banner['IMAGE']+'"/></td></tr>';
            }
            else{
                image = '';
            }
            $('.banner-details-table tbody').html(
                image+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">TITLE</td><td>'+banner['TITLE']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">DESCRIPTION</td><td>'+banner['DESCRIPTION']+'</td></tr>'
            );
        }).success(function () {
            $('.ajax-loader2').css('visibility','hidden');
        });
    });
</script>