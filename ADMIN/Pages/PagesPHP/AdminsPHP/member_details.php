<?php
    $MEMBER_ID = $_GET['id'];
?>
<div class="ajax-loader2">
    <img src="Images/Preloader_1.gif" class="img-responsive"/>
</div>
 <table class="table table-striped table-bordered member-details-table">
        <tbody></tbody>
 </table>

<script>
    $(document).ready(function(){
        $('.ajax-loader2').css('visibility','visible');
        $.get('Pages/PagesPHP/AdminsPHP/GetDetails.php?id=<?php echo $MEMBER_ID ?>',function(data) {
            var person = $.parseJSON(data);

            $('.member-details-table tbody').html(
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">ID</td><td>['+person[0]['ID']+']</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">FIRST NAME</td><td>'+person[0]['FIRST_NAME']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">LAST NAME</td><td>'+person[0]['LAST_NAME']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">E-MAIL</td><td>'+person[0]['EMAIL']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">ROLE</td><td>'+person[0]['TYPE']+'</td></tr>'
            );
            $(person[0]['FEATURES']).each(function(id,feature){
                $('.member-details-table tbody').append(
                    '<tr><td style="background-color: #0c5460;color:#F4F4F4;">'+feature['FEATURE']+'</td><td>'+feature['VALUE']+'</td></tr>'
                );
            });
        }).success(function () {
            $('.ajax-loader2').css('visibility','hidden');
        });
    });
</script>