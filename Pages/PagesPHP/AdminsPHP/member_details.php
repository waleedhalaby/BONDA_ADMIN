<?php
    $MEMBER_ID = $_GET['id'];
?>

 <table class="table table-striped table-bordered member-details-table">
        <tbody></tbody>
 </table>

<script>
    $(document).ready(function(){

        $.get('Pages/PagesPHP/AdminsPHP/GetDetails.php?id=<?php echo $MEMBER_ID ?>',function(data) {
            var person = $.parseJSON(data);

            $('.member-details-table tbody').html(
                '<tr><td>ID</td><td>['+person[0]['ID']+']</td></tr>'+
                '<tr><td>FIRST NAME</td><td>'+person[0]['FIRST_NAME']+'</td></tr>'+
                '<tr><td>LAST NAME</td><td>'+person[0]['LAST_NAME']+'</td></tr>'+
                '<tr><td>E-MAIL</td><td>'+person[0]['EMAIL']+'</td></tr>'+
                '<tr><td>ROLE</td><td>'+person[0]['TYPE']+'</td></tr>'
            );
            $(person[0]['FEATURES']).each(function(id,feature){
                $('.member-details-table tbody').append(
                    '<tr><td>'+feature['FEATURE']+'</td><td>'+feature['VALUE']+'</td></tr>'
                );
            });
        });
    });
</script>