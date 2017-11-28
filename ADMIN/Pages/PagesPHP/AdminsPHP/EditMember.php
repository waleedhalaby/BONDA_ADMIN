<?php
require ('../../../Handlers/DBCONNECT.php');

$MEMBER_ID = $_GET['id'];
$COUNTER = $_GET['features'];

$FIRST_NAME = $_POST['EditfName'];
$FIRST_NAME = ucfirst(strtolower($FIRST_NAME));
$LAST_NAME = $_POST['EditlName'];
$LAST_NAME = ucfirst(strtolower($LAST_NAME));
$EMAIL = $_POST['EditEmail'];
$EMAIL = strtolower($EMAIL);

$json = Array();
for($i = 0; $i < $COUNTER ; $i++){
    $json[$i]['FEATURE_ID'] = $_POST['FeatureID'];
    $json[$i]['VALUE'] = $_POST['FEATURE'.$i];
}

$sql = "UPDATE persons SET FIRST_NAME = '".$FIRST_NAME."',LAST_NAME = '".$LAST_NAME."',EMAIL = '".$EMAIL."' 
        WHERE ID = ".$MEMBER_ID;
$result = mysqli_query($con,$sql);

for($i = 0; $i < $COUNTER ; $i++) {
    $sql = "UPDATE person_feature_values SET VALUE = " . $json[$i]['VALUE'] . "WHERE ID = " . $json[$i]['FEATURE_ID'];
    $result = mysqli_query($con,$sql);
}

echo true;
?>