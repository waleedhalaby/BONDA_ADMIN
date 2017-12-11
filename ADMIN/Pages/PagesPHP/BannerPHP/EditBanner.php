<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$TITLE = ucfirst(strtolower($_POST['editTitle']));
$DESCRIPTION = ucfirst($_POST['editDescription']);
date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];
$BANNER_ID = $_GET['id'];
$sql = "UPDATE banner_images SET TITLE = '".$TITLE."', DESCRIPTION = '".$DESCRIPTION."' WHERE ID = '".$BANNER_ID."'";
$result = mysqli_query($con,$sql);

if($result){
    $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                        ('".$DATETIME."','".$MAKER_ID."','21','Banner is updated')";
    $result = mysqli_query($con,$sql);
    if($MAKER_ID != 111111){
        $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                        ('".$DATETIME."','icon-picture','yellow','Pages/Banner.php','Banner is updated','0')";
        $result = mysqli_query($con,$sql);
    }

    echo $BANNER_ID;
}
else{
    echo 'Error occurred, please contact your administrator.';
}
?>