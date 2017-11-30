<?php
require ('../../../Handlers/DBCONNECT.php');

date_default_timezone_set('Africa/Cairo');
$DATETIME = date_create()->format('Y-m-d H:i:s');

$MAKER_ID = $_GET['maker'];

$MEMBER_ID = $_GET['id'];

$sql = "DELETE FROM person_feature_values WHERE PERSON_ID = ".$MEMBER_ID;
$result = mysqli_query($con,$sql);

$sql = "DELETE FROM person_privileges WHERE PERSON_ID = ".$MEMBER_ID;
$result = mysqli_query($con,$sql);

if($result){
    $sql = "DELETE FROM persons WHERE ID = ".$MEMBER_ID;
    $result = mysqli_query($con,$sql);
}

$sql = "INSERT INTO log_activities (DATE_TIME,PERSON_ID,PAGE_ID,VALUE) VALUES
                                ('".$DATETIME."','".$MAKER_ID."','6','Member [".$MEMBER_ID."] is deleted')";
$result = mysqli_query($con,$sql);

echo json_encode($result);
?>