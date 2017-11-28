<?php
require ('../../../Handlers/DBCONNECT.php');

$PRODUCT_ID = $_GET['id'];

$sql = "DELETE FROM product_feature_values WHERE PRODUCT_ID = ".$PRODUCT_ID;
$result = mysqli_query($con,$sql);

$sql = "DELETE FROM products_images WHERE PRODUCT_ID = ".$PRODUCT_ID;
$result = mysqli_query($con,$sql);

if($result){
    $sql = "DELETE FROM products WHERE ID = ".$PRODUCT_ID;
    $result = mysqli_query($con,$sql);
}
echo json_encode($result);
?>