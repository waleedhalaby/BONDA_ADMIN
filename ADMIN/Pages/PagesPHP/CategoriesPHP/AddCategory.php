<?php
require ('../../../Handlers/DBCONNECT.php');

$CATEGORY = ucfirst(strtolower($_POST['addCategory']));

$sql = "INSERT INTO product_categories (CATEGORY,IS_ACTIVE) VALUES
        ('".$CATEGORY."','1')";
$result = mysqli_query($con,$sql);

echo json_encode($result);
?>