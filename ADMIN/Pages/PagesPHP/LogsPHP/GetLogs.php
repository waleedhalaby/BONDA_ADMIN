<?php
require('../../../Handlers/DBCONNECT.php');
session_start();

$sql = "SELECT L.DATE_TIME, P.FIRST_NAME, P.LAST_NAME, PG.TITLE, L.VALUE FROM log_activities L
        INNER JOIN persons P ON L.PERSON_ID = P.ID
        INNER JOIN pages PG ON L.PAGE_ID = PG.ID ORDER BY L.DATE_TIME DESC";
$result = mysqli_query($con,$sql);
$rows = mysqli_num_rows($result);
$json = Array();
if($rows > 0){
    $i = 0;
    while($row = mysqli_fetch_array($result)){
        $json[$i]['DATE_TIME'] = $row['DATE_TIME'];
        $json[$i]['MEMBER_NAME'] = $row['FIRST_NAME'].' '.$row['LAST_NAME'];
        $json[$i]['PAGE'] = $row['TITLE'];
        $json[$i]['DESCRIPTION'] = $row['VALUE'];
        $i++;
    }

    echo json_encode($json);
}
?>