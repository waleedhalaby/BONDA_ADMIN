<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Handler.php');
require ('../../../Handlers/Authenticate.php');

date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$BANNER_ID = $_GET['id'];

$IMAGE_PATH = '';
$sql = "SELECT IMAGE_PATH FROM banner_images WHERE ID = ".$BANNER_ID;
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){
    $IMAGE_PATH = $row['IMAGE_PATH'];
}
if(isset($IMAGE_PATH) || !empty($IMAGE_PATH)){
    $filename = '../../../'.$IMAGE_PATH;
    if (file_exists($filename)) {
        unlink($filename);
    }
}

$sql = "DELETE FROM banner_images WHERE ID = ".$BANNER_ID;
$result = mysqli_query($con,$sql);
if($result){
    $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                    ('".$DATETIME."','".$MAKER_ID."','21','Banner is deleted')";
    $result = mysqli_query($con,$sql);

    if($MAKER_ID != 111111){
        $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                    ('".$DATETIME."','icon-picture','yellow','Pages/Banner.php','Banner is deleted','0')";
        $result = mysqli_query($con,$sql);
    }
    echo "Banner is deleted successfully.";
}
else{
    echo 'Error occurred, please contact your administrator.';
}
?>