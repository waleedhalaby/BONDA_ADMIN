<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$CATEGORY_ID = $_GET['id'];

$sql = "UPDATE categories SET IMAGE_PATH = NULL WHERE ID = ".$CATEGORY_ID;
$result = mysqli_query($con, $sql);
?>