<?php
require ('../DBCONNECT.php');

session_start();

$PERSON_ID = $_SESSION['PERSON_ID'];
$CART_ID = $_GET['id'];

date_default_timezone_set('Africa/Cairo');
$UNIQUE_ID = uniqid();
$DATETIME = date_create()->format('Y-m-d H:i:s');

$sql = "INSERT INTO orders (UNIQUE_ID,PERSON_ID,ORDER_DATE_TIME,ORDER_STATUS_ID,PAYMENT_TYPE_ID,CART_ID)
        VALUES ('".$UNIQUE_ID."','".$PERSON_ID."','".$DATETIME."','1','1','".$CART_ID."')";
$result = mysqli_query($con,$sql);

$sql = "UPDATE carts SET CART_STATUS_ID = 2 WHERE ID = '".$CART_ID."'";
$result = mysqli_query($con,$sql);

echo true;
?>