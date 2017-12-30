<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$DESIGNER_ID = $_GET['id'];


$sql = "UPDATE designers SET IMAGE_PATH = NULL WHERE ID = ".$DESIGNER_ID;
$result = mysqli_query($con, $sql);
?>