<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$CATEGORY_ID = $_GET['id'];

$IMAGE_PATH = '';
$sql = "SELECT IMAGE_PATH FROM categories WHERE ID = ".$CATEGORY_ID;
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){
    $IMAGE_PATH = $row['IMAGE_PATH'];
}

$filename = '../../../'.$IMAGE_PATH;
if (file_exists($filename))
{
    unlink($filename);
}

$sql = "UPDATE categories SET IMAGE_PATH = NULL WHERE ID = ".$CATEGORY_ID;
$result = mysqli_query($con, $sql);
?>