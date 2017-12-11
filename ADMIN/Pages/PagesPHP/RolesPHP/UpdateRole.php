<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$ROLE_ID = $_GET['id'];
$STATUS = ($_POST['editRoleVal'] == "true" ? 1 : 0);
$sql = "UPDATE person_types SET IS_ACTIVE = ".$STATUS." WHERE ID = ".$ROLE_ID;
$result = mysqli_query($con,$sql);

$sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','18','Role is updated')";
$result = mysqli_query($con,$sql);
if($MAKER_ID != 111111){
    $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                                ('".$DATETIME."','icon-user-md','yellow','Pages/MemberRoles.php','Role is updated','0')";
    $result = mysqli_query($con,$sql);
}

if($STATUS == 1){
    echo "Role is activated successfully.";
}
else{
    echo "Role is deactivated successfully.";
}
?>