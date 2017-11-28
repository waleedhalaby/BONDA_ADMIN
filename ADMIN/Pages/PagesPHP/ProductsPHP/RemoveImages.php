<?php
require ('../../../Handlers/DBCONNECT.php');
$PRODUCT_ID = $_GET['id'];
$IMAGE = $_GET['image'];

$sql = "DELETE FROM products_images WHERE PRODUCT_ID = '".$PRODUCT_ID."' AND IMAGE_PATH = '".$IMAGE."'";
$result = mysqli_query($con, $sql);
?>