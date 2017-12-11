<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$ORDER_ID = $_GET['id'];
$STATUS = $_GET['s'];
$UNIQUE = $_GET['u'];


$sql = "DELETE FROM orders WHERE ID = ".$ORDER_ID;
$result = mysqli_query($con,$sql);

if($STATUS == "4"){
    $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                    ('".$DATETIME."','".$MAKER_ID."','15','Order [".$UNIQUE."] is deleted')";
    $result = mysqli_query($con,$sql);

    if($MAKER_ID != 111111){
        $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                    ('".$DATETIME."','icon-shopping-cart','black','Pages/DeliveredOrders.php','Order [".$UNIQUE."] is deleted','0')";
        $result = mysqli_query($con,$sql);
    }
}
elseif($STATUS == "5"){
    $sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                    ('".$DATETIME."','".$MAKER_ID."','17','Order [".$UNIQUE."] is deleted')";
    $result = mysqli_query($con,$sql);

    if($MAKER_ID != 111111){
        $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                    ('".$DATETIME."','icon-ban-circle','black','Pages/CancelledOrders.php','Order [".$UNIQUE."] is deleted','0')";
        $result = mysqli_query($con,$sql);
    }
}

echo "Order [".$UNIQUE."] is deleted successfully.";

?>