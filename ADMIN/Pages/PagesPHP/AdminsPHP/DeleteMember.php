<?php
require ('../../../Handlers/DBCONNECT.php');

$MEMBER_ID = $_GET['id'];

$sql = "DELETE FROM person_feature_values WHERE PERSON_ID = ".$MEMBER_ID;
$result = mysqli_query($con,$sql);

$sql = "DELETE FROM person_privileges WHERE PERSON_ID = ".$MEMBER_ID;
$result = mysqli_query($con,$sql);

if($result){
    $sql = "DELETE FROM persons WHERE ID = ".$MEMBER_ID;
    $result = mysqli_query($con,$sql);
}
echo json_encode($result);
?>