<?php
require ('../DBCONNECT.php');

session_start();

$PERSON_ID = $_SESSION['PERSON_ID'];
$CART_ID = $_GET['id'];

date_default_timezone_set('Africa/Cairo');
$UNIQUE_ID = uniqid();
$DATETIME = date_create()->format('Y-m-d H:i:s');

$sql = "SELECT TOTAL FROM carts WHERE ID = ".$CART_ID;
$res = mysqli_query($con,$sql);

$TOTAL = null;
while($row = mysqli_fetch_array($res)){
    $TOTAL = $row['TOTAL'];
}

$sql = "INSERT INTO orders (UNIQUE_ID,PERSON_ID,ORDER_DATE_TIME,TOTAL,ORDER_STATUS_ID,PAYMENT_TYPE_ID,CART_ID)
        VALUES ('".$UNIQUE_ID."','".$PERSON_ID."','".$DATETIME."','".$TOTAL."','1','1','".$CART_ID."')";
$result = mysqli_query($con,$sql);

$sql = "UPDATE carts SET CART_STATUS_ID = 2 WHERE ID = '".$CART_ID."'";
$result = mysqli_query($con,$sql);

$sql = "INSERT INTO notifications (NOTIFY_DATE_TIME,ICON,COLOR,PAGE_URL,DESCRIPTION,IS_SEEN) VALUES
                            ('".$DATETIME."','icon-envelope','black','Pages/PendingOrders.php','New order is pending','0')";
$result = mysqli_query($con,$sql);

echo true;
?>