<?php
require ('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$BANNER_ID = $_GET['id'];

$IMAGE_PATH = '';
$sql = "SELECT IMAGE_PATH FROM contact_info WHERE ID = ".$BANNER_ID;
$result = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($result)){
    $IMAGE_PATH = $row['IMAGE_PATH'];
}

$filename = '../../../'.$IMAGE_PATH;
if (file_exists($filename))
{
    unlink($filename);
}

$sql = "UPDATE contact_info SET IMAGE_PATH = NULL WHERE ID = ".$BANNER_ID;
$result = mysqli_query($con, $sql);
?>