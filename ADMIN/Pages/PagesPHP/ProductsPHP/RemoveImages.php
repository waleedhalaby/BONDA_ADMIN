<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$PRODUCT_ID = $_GET['id'];
$IMAGE = $_GET['imagepath'];

$filename = '../../../'.$IMAGE;
if (file_exists($filename))
{
    unlink($filename);
}

$sql = "DELETE FROM products_images WHERE PRODUCT_ID = '".$PRODUCT_ID."' AND IMAGE_PATH = '".$IMAGE."'";
$result = mysqli_query($con, $sql);
?>