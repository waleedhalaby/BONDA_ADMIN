<?php
session_start();
$PERSON_ID = $_SESSION['id'];

$DESIGNER_ID = $_GET['id'];
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
        <i class="icon-zoom-in"></i>
        <em>Designer Details</em>
    </li>
</ul>
<div class="ajax-loader2">
    <img src="Images/Preloader_1.gif" class="img-responsive"/>
</div>
<table class="table table-striped table-bordered designer-details-table">
    <tbody></tbody>
</table>
<button style="float: right;" class="btn btn-danger" onclick="$('#content').load('Pages/Designers.php')">Back</button>

<script>
    $(document).ready(function(){
        $('.ajax-loader2').css('visibility','visible');
        $.get('Pages/PagesPHP/DesignersPHP/GetDetails.php?id=<?php echo $DESIGNER_ID ?>',function(data) {
            var designer = $.parseJSON(data);
            var status = '';
            if(designer[0]['IS_ACTIVE'].indexOf('1') >= 0){
                status = '<span class="label label-warning">ACTIVATED</span>';
            }
            else if(designer[0]['IS_ACTIVE'].indexOf('0') >= 0){
                status = '<span class="label label-info">DEACTIVATED</span>';
            }
            $('.designer-details-table tbody').html(
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">NAME</td><td>'+designer[0]['NAME']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">DESCRIPTION</td><td>'+designer[0]['DESCRIPTION']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">NO. OF PRODUCTS</td><td>'+(designer[0]['PRODUCTS'] === "0" ? "No Products" : designer[0]['PRODUCTS'] +' Products')+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">IS ACTIVE</td><td>'+status+'</td></tr>'
            );
        }).success(function () {
            $('.ajax-loader2').css('visibility','hidden');
        });
    });
</script>