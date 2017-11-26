<?php
require ('../../../Handlers/DBCONNECT.php');

$MEMBER_ID = $_GET['id'];

$sql = "DELETE FROM PERSON_FEATURE_VALUES WHERE PERSON_ID = ".$MEMBER_ID;
$result = mysqli_query($con,$sql);

$sql = "DELETE FROM PERSON_PRIVILEGES WHERE PERSON_ID = ".$MEMBER_ID;
$result = mysqli_query($con,$sql);

if($result){
    $sql = "DELETE FROM PERSONS WHERE ID = ".$MEMBER_ID;
    $result = mysqli_query($con,$sql);
}
echo json_encode($result);
?>