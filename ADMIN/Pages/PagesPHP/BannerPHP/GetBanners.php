<?php
require('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$sql = "SELECT ID, IMAGE_PATH FROM banner_images";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
$json = Array();
if($rows > 0){
    $i = 0;
    while($row = mysqli_fetch_array($result)){
        $json[$i]['ID'] = $row['ID'];
        $json[$i]['IMAGE'] = $row['IMAGE_PATH'];
        $i++;
    }

    echo json_encode($json);
}
?>