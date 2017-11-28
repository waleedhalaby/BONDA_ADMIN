<?php
$con = mysqli_connect('localhost:3306','root','','jewelryDB');

if(mysqli_connect_errno()){
    echo 'Failed to connect to MYSQL: ' . mysqli_connect_error();
}
session_start();

$PERSON_ID = $_SESSION['PERSON_ID'];
$CART_ID = $_GET['id'];

date_default_timezone_set('Africa/Cairo');
$UNIQUE_ID = uniqid();
$DATETIME = date_create()->format('Y-m-d H:i:s');

$sql = "INSERT INTO ORDERS (UNIQUE_ID,PERSON_ID,ORDER_DATE_TIME,ORDER_STATUS_ID,PAYMENT_TYPE_ID,CART_ID)
        VALUES ('".$UNIQUE_ID."','".$PERSON_ID."','".$DATETIME."','1','1','".$CART_ID."')";
$result = mysqli_query($con,$sql);

$_SESSION['COUNT'] = null;
echo true;
?>