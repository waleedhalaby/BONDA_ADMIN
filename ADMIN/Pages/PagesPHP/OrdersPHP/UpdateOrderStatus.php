<?php
require ('../../../Handlers/DBCONNECT.php');

$STATUS = $_GET['s'];
$ORDER_ID = $_GET['id'];

$sql = "UPDATE orders SET ORDER_STATUS_ID = ".$STATUS." WHERE ID = '".$ORDER_ID."'";
$result = mysqli_query($con,$sql);
echo true;

?>