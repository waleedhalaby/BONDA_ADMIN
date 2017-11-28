<?php
require ('../../../Handlers/DBCONNECT.php');

$PRODUCT_ID = $_GET['id'];

$sql = "DELETE FROM PRODUCT_FEATURE_VALUES WHERE PRODUCT_ID = ".$PRODUCT_ID;
$result = mysqli_query($con,$sql);

$sql = "DELETE FROM PRODUCTS_IMAGES WHERE PRODUCT_ID = ".$PRODUCT_ID;
$result = mysqli_query($con,$sql);

if($result){
    $sql = "DELETE FROM PRODUCTS WHERE ID = ".$PRODUCT_ID;
    $result = mysqli_query($con,$sql);
}
echo json_encode($result);
?>