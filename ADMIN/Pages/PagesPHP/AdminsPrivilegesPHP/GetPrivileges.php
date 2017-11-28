<?php
require ('../../../Handlers/DBCONNECT.php');
session_start();
$ID = $_SESSION['id'];

if($_GET['id'] != 0){
    $ID = $_GET['id'];
}

$sql = "SELECT DISTINCT PP.ID, P.PRIVILEGE,PP.VALUE FROM person_privileges PP
            INNER JOIN privileges P ON PP.PRIVILEGE_ID = P.ID WHERE PP.PERSON_ID = ".$ID;
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);

if($rows > 0){
    $json = mysqli_fetch_all($result);

    echo json_encode($json);
}
?>