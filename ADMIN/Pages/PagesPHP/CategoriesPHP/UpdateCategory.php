<?php
require ('../../../Handlers/DBCONNECT.php');

$CATEGORY_ID = $_GET['id'];
$STATUS = ($_POST['editCategoryVal'] == "true" ? 1 : 0);
echo $_POST['editCategoryVal'];
$sql = "UPDATE product_categories SET IS_ACTIVE = ".$STATUS." WHERE ID = ".$CATEGORY_ID;
echo $sql;
$result = mysqli_query($con,$sql);

echo json_encode($result);
?>