<?php
require('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$sql = "SELECT ID, IMAGE_PATH, PARAGRAPH, OWNER_NAME FROM about_us";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
$json = Array();
if($rows > 0){
    while($row = mysqli_fetch_array($result)){
        $json['ID'] = $row['ID'];
        $json['IMAGE'] = $row['IMAGE_PATH'];
        $json['PARAGRAPH'] = $row['PARAGRAPH'];
        $json['OWNER'] = $row['OWNER_NAME'];
    }

    echo json_encode($json);
}
?>