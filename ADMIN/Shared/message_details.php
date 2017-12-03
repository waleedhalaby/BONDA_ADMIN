<?php
    $MESSAGE_ID = $_GET['id'];
?>

 <table class="table table-striped table-bordered message-details-table">
        <tbody></tbody>
 </table>
<div id="message_details"></div>

<script>
    $(document).ready(function(){

        $.get('Shared/ShowMessage.php?id=<?php echo $MESSAGE_ID ?>',function(data) {
            var message = $.parseJSON(data);

            $('.message-details-table tbody').html(
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">RECEIVED DATE</td><td>['+message['MESSAGE_DATE_TIME']+']</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">FROM</td><td>'+message['FROM_PERSON']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">E-MAIL</td><td>'+message['FROM_EMAIL']+'</td></tr>'+
                '<tr><td style="background-color: #0c5460;color:#F4F4F4;">TO</td><td>'+message['TO_PERSON']+'</td></tr>'
            );

            $('#message_details').html(
                '<h3>'+message['TITLE']+'</h3>'+
                '<p style="border-radius: 5px;padding:10px;background-color: #0c5460;color:#F4F4F4;">'+message['DESCRIPTION']+'</p>'
            );
        });
    });
</script>