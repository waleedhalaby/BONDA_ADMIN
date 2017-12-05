<?php session_start(); $PERSON_ID = $_SESSION['id']; ?>

<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
    <i style="margin-bottom: 0;margin-top: 0" class="icon-bell"></i>
    <span id="notifyCount" style="font-size: 10px;" class="badge red"></span>
</a>

<ul class="dropdown-menu notifications">

</ul>

<script>

$(document).ready(function(){
    setInterval(function () {
        CheckSessionTimeout();
    }, 10000);
    if(!CheckPrivilege('SHOW_NOTIFICATIONS')){
        $('#notificationDiv').css('display','none');
    }
    else {
        $('#notificationDiv').css('display','block');
        GetNotifications();
        setInterval(function () {
            GetNotifications();
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

function GetNotifications(){
    $.get('Shared/GetNotifications.php?id=<?php echo $PERSON_ID; ?>',function(data){
        var notifications = $.parseJSON(data);

        if(notifications.length > 0){
            $('#notifyCount').css('visibility','visible');
            $('#notifyCount').html(notifications.length);
            $('.notifications').html(
                '<li class="dropdown-menu-title">' +
                '        <span>Unseen Notifications</span>' +
                '    </li>');
            $(notifications).each(function(id,notification){
                $('.notifications').append(
                    '<li id="'+notification['ID']+'">' +
                    '<a onclick="ShowPage(\''+notifications.length+'\',\''+notification['ID']+'\',\''+notification['PAGE_URL']+'\')">'+
                    '<span class="icon '+notification['COLOR']+'"><i class="'+notification['ICON']+'"></i></span>'+
                    '<span class="message">'+notification['DESCRIPTION']+'</span>'+
                    '<span class="time">'+notification['NOTIFY_DATE_TIME']+'</span>'+
                    '</a>'+
                    '</li>');
            });
            $('.notifications').append(
                '<li class="dropdown-menu-sub-footer">' +
                '<a>Last 5 unseen notifications</a>' +
                '</li>')
        }
        else{
            $('#notifyCount').css('visibility','hidden');
            $('.notifications').html(
                '<li class="dropdown-menu-title">' +
                '<span>Unseen Notifications</span>' +
                '</li><li class="dropdown-menu-sub-footer"><a>No notifications found</a></li>')
        }
    });
}

function ShowPage(length,id,page){
    $.ajax({
        type:'POST',
        url:'Shared/UpdateNotifyStatus.php?id='+id,
        success:function(){
            var l = length - 1;
            if(l === 0){
                $('#notifyCount').css('visibility','hidden');
                $('.notifications').html(
                    '<li class="dropdown-menu-title">' +
                    '<span>Unseen Notifications</span>' +
                    '</li><li class="dropdown-menu-sub-footer"><a>No notifications found</a></li>')
            }
            else{
                $('#notifyCount').html(length - 1);
            }
            $('.notifications li#'+id).remove();
            $('#content').load(page);
        }
    })
}
</script>