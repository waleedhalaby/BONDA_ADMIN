<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$TITLE = ucfirst(strtolower($_POST['addTitle']));
$DESCRIPTION = ucfirst($_POST['addDescription']);
date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$sql = "INSERT INTO banner_images (TITLE,DESCRIPTION) VALUES
('".$TITLE."','".$DESCRIPTION."')";
$result = mysqli_query($con,$sql);
if($result){

    $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                        ('".$DATETIME."','".$MAKER_ID."','21','Banner image is added')";
    $result = mysqli_query($con,$sql);
    if($MAKER_ID != 111111){
        $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                        ('".$DATETIME."','icon-picture','yellow','Pages/Banner.php','New banner image is added','0')";
        $result = mysqli_query($con,$sql);
    }

    $sql = "SELECT ID FROM banner_images WHERE TITLE = '" . $TITLE . "'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $ID = 0;
        while ($row = mysqli_fetch_array($result)) {
            $ID = $row['ID'];
        }
        echo $ID;
    }
}
else{
    echo 'Error occurred, please contact your administrator.';
}
?>