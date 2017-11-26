<?php
require ('../../../Handlers/DBCONNECT.php');

$CATEGORY = ucfirst(strtolower($_POST['addCategory']));

$sql = "INSERT INTO PRODUCT_CATEGORIES (CATEGORY,IS_ACTIVE) VALUES
        ('".$CATEGORY."','1')";
$result = mysqli_query($con,$sql);

echo json_encode($result);
?>