<?php session_start(); $PERSON_ID = $_SESSION['id']; ?>

<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    <i style="margin-bottom: 0;margin-top: 0" class="icon-envelope"></i>
    <span id="messageCount" style="font-size: 10px;" class="badge red"></span>
</a>

<ul class="dropdown-menu messages">

</ul>

<script>

$(document).ready(function(){
    setInterval(function () {
        CheckSessionTimeout();
    }, 10000);
    if(!CheckPrivilege('SHOW_MESSAGES')){
        $('#messageDiv').css('display','none');
    }
    else {
        $('#messageDiv').css('display','block');
        GetMessages();
        setInterval(function () {
            GetMessages();
        }, 10000);
    }
});
function CheckSessionTimeout(){
    <?php
        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
            // last request was more than 30 minutes ago
            session_unset();     // unset $_SESSION variable for the run-time
            session_destroy();   // destroy session data in storage
        }
        $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
    ?>
}

function GetMessages(){
    $.get('Shared/GetMessages.php?id=<?php echo $PERSON_ID; ?>',function(data){
        var messages = $.parseJSON(data);

        if(messages.length > 0){
            $('#messageCount').css('visibility','visible');
            $('#messageCount').html(messages.length);
            $('.messages').html(
                '<li class="dropdown-menu-title">' +
                '        <span>Unseen Messages</span>' +
                '    </li>');
            $(messages).each(function(id,message){
                $('.messages').append(
                    '<li id="'+message['ID']+'">'+
                        '<a onclick="ShowPage(\''+message.length+'\',\''+message['ID']+'\')">'+
                            '<span class="avatar"><img src="Images/user.jpg" alt="Avatar"></span>'+
                            '<span class="header">'+
                                '<span class="from">'+
                                    message['FROM_PERSON']+
                                '</span>'+
                                '<span class="time">'+
                                    message['MESSAGE_DATE_TIME']+
                                '</span>'+
                            '</span>'+
                            '<span class="message">'+
                                message['TITLE']+
                            '</span>'+
                        '</a>'+
                    '</li>');
            });
            $('.messages').append(
                '<li class="dropdown-menu-sub-footer">' +
                '<a>Last 5 unseen messages</a>' +
                '</li>')
        }
        else{
            $('#messageCount').css('visibility','hidden');
            $('.messages').html(
                '<li class="dropdown-menu-title">' +
                '<span>Unseen Messages</span>' +
                '</li><li class="dropdown-menu-sub-footer"><a>No messages found</a></li>')
        }
    });
}

function ShowPage(length,id){
    $.ajax({
        type:'POST',
        url:'Shared/UpdateMessageStatus.php?id='+id,
        success:function(){
            var l = length - 1;
            if(l === 0){
                $('#messageCount').css('visibility','hidden');
                $('.messages').html(
                    '<li class="dropdown-menu-title">' +
                    '<span>Unseen Messages</span>' +
                    '</li><li class="dropdown-menu-sub-footer"><a>No messages found</a></li>')
            }
            else{
                $('#messageCount').html(length - 1);
            }
            $('.messages li#'+id).remove();
            ShowModal('Message Details','Close','Shared/message_details.php?id='+id);
        }
    })
}
</script>