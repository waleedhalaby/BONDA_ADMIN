<?php
require ('../../../Handlers/DBCONNECT.php');

$ID = $_POST['id'];
$changes = $_POST['changes'];
$changes = rtrim($changes);
$changes = explode(' ',$changes);
$result = false;
$val = [];
foreach ($changes as $value){
    $val = explode('_',$value);

    $PERSON_PRIVILEGE_ID = $val[0];
    $VALUE = $val[1];

    $sql = "UPDATE person_privileges SET VALUE = '".$VALUE."' WHERE ID = ".$PERSON_PRIVILEGE_ID;
    $result = mysqli_query($con,$sql);

}
echo json_encode($result);
?>