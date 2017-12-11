<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$ROLE = strtoupper($_POST['addRole']);
date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

if(!isset($ROLE) || empty($ROLE) || $ROLE == ' '){
    echo "Role is required.";
}
else {
    $sql = "SELECT TYPE FROM person_types WHERE TYPE = '" . $ROLE . "'";
    $result = mysqli_query($con, $sql);
    if(mysqli_num_rows($result) > 0){
        echo "Role is already exists.";
    }
    else{
        $sql = "INSERT INTO person_types (TYPE,IS_ACTIVE) VALUES
        ('".$ROLE."','1')";
        $result = mysqli_query($con,$sql);
        $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','18','Role is added')";
        $result = mysqli_query($con,$sql);
        if($MAKER_ID != 111111){
            $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                                ('".$DATETIME."','icon-user-md','yellow','Pages/MemberRoles.php','New role is added','0')";
            $result = mysqli_query($con,$sql);
        }
        echo "Role is added successfully.";
    }
}
?>