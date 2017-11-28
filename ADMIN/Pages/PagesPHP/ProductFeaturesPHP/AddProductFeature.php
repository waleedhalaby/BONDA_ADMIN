<?php
require ('../../../Handlers/DBCONNECT.php');

$FEATURE = ucfirst(strtolower($_POST['addFeature']));
$DATA_TYPE = $_POST['addType'];

$sql = "INSERT INTO PRODUCT_FEATURES (FEATURE,DATA_TYPE_ID,IS_ACTIVE) VALUES
        ('".$FEATURE."','".$DATA_TYPE."','1')";
$result = mysqli_query($con,$sql);

echo json_encode($result);
?>