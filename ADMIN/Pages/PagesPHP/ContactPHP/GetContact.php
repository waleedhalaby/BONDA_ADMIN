<?php
require('../../../Handlers/DBCONNECT.php');
require ('../../../Handlers/Authenticate.php');

$sql = "SELECT ID, IMAGE_PATH, LOCATION, TELEPHONE1, TELEPHONE2, EMAIL, LATITUDE, LONGITUDE FROM contact_info";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
$json = Array();
if($rows > 0){
    while($row = mysqli_fetch_array($result)){
        $json['ID'] = $row['ID'];
        $json['IMAGE'] = $row['IMAGE_PATH'];
        $json['LOCATION'] = $row['LOCATION'];
        $json['TEL1'] = $row['TELEPHONE1'];
        $json['TEL2'] = $row['TELEPHONE2'];
        $json['EMAIL'] = $row['EMAIL'];
        $json['LATITUDE'] = $row['LATITUDE'];
        $json['LONGITUDE'] = $row['LONGITUDE'];
    }

    echo json_encode($json);
}
?>