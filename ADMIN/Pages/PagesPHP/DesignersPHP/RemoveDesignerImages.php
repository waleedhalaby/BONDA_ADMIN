<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$DESIGNER_ID = $_GET['id'];

$IMAGE_PATH = '';
$sql = "SELECT IMAGE_PATH FROM designers WHERE ID = ".$DESIGNER_ID;
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){
    $IMAGE_PATH = $row['IMAGE_PATH'];
}

$filename = '../../../'.$IMAGE_PATH;
if (file_exists($filename))
{
    unlink($filename);
}

$sql = "UPDATE designers SET IMAGE_PATH = NULL WHERE ID = ".$DESIGNER_ID;
$result = mysqli_query($con, $sql);
?>