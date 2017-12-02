<?php
require ('../../../Handlers/DBCONNECT.php');

$STATUS = $_GET['s'];
$ORDER_ID = $_GET['id'];
$UNIQUE_ID = $_GET['u'];
$MAKER_ID = $_GET['m'];

date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$sql = "UPDATE orders SET ORDER_STATUS_ID = ".$STATUS." WHERE ID = '".$ORDER_ID."'";
$result = mysqli_query($con,$sql);

$stat = '';
$url = '';
$url_id = '';
if($STATUS == "2"){
    $stat = 'Queued';
    $url = 'Pages/QueuedOrders.php';
    $url_id = '13';
    $icon = 'icon-envelope-alt';
}
elseif($STATUS == "3"){
    $stat = 'Shipped';
    $url = 'Pages/ShippedOrders.php';
    $url_id = '14';
    $icon = 'icon-truck';
}
elseif($STATUS == "4"){
    $stat = 'Delivered';
    $url = 'Pages/DeliveredOrders.php';
    $url_id = '15';
    $icon = 'icon-shopping-cart';
}
elseif ($STATUS == "5"){
    $stat = 'Cancelled';
    $url = 'Pages/CancelledOrders.php';
    $url_id = '17';
    $icon = 'icon-ban-circle';
}

$sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','".$url_id."','Order [".$UNIQUE_ID."] is ".$stat."')";
$result = mysqli_query($con,$sql);

if($MAKER_ID != 111111){
    $sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                                ('".$DATETIME."','".$icon."','black','".$url."','Order [".$UNIQUE_ID."] is ".$stat."','0')";
    $result = mysqli_query($con,$sql);
}

echo true;

?>