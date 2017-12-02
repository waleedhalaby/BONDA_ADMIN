<?php
require ('../../../Handlers/DBCONNECT.php');
date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$ID = $_POST['id'];
$changes = $_POST['changes'];
$changes = rtrim($changes);
$changes = explode(' ',$changes);
$result = false;
$val = [];
foreach ($changes as $value){
    $val = explode('_',$value);

    $PERSON_PRIVILEGE_ID = $val[0];
    $VALUE = $val[1];

    echo $PRIVILEGE." ".$PERSON_PRIVILEGE_ID." ".$VALUE;
    $sql = "UPDATE person_privileges SET VALUE = '".$VALUE."' WHERE ID = ".$PERSON_PRIVILEGE_ID;
    $result = mysqli_query($con,$sql);
}
    $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','7','Privileges for Member [".$ID."] is updated')";
    $result = mysqli_query($con,$sql);
    if($MAKER_ID != 111111){
        $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                                    ('".$DATETIME."','icon-eye-open','red','Pages/AdminsPrivileges.php','Privilege is updated','0')";
        $result = mysqli_query($con,$sql);
    }
echo json_encode($result);
?>